<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Scheduling\Schedule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->get();
        $categories = Category::pluck('name', 'id');
        return view('dashboard.posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'title' => 'Dashboard | Post'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->session()->forget('temp_image_names');
        $posts = Post::with('category')->get();
        $category = Category::with('posts')->get();
        $tags = Tag::all();
        return view('dashboard.posts.create', [
            'title' => 'Dashboard | Post',
            'posts' => $posts,
            'tags' => $tags,
            'category' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'content' => 'required',
            'tags' => 'required',
        ], ['tags.required' => 'Please select at least one tag']);



        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-img');
        }

        if ($request->has('publish')) {
            $validatedData['published'] = 1; // Set published to 1 if Publish button was pressed
        } elseif ($request->has('unpublish')) {
            $validatedData['published'] = 0; // Set published to 0 if Unpublish button was pressed
        }

        // dd($validatedData);
        $post = Post::create($validatedData);

        foreach ($request->tags as $tagId) {
            DB::table('post_tag')->insert([
                'post_id' => $post->id,
                'tag_id' => $tagId
            ]);
        }

        $postSlug = $request->input('slug');
        $tempImageNames = $request->session()->get('temp_image_names');
        $tempImageUrls = $request->session()->get('temp_image_urls');

        foreach ($tempImageNames as $key => $tempImageName) {
            $finalImageName = "post-images/{$postSlug}/{$tempImageName}";
            Storage::disk('public')->put($finalImageName, Storage::disk('temp')->get($tempImageName)); // Move the image from the temp disk to the public disk under the post directory
            $finalImageUrl = Storage::disk('public')->url($finalImageName); // Generate the final URL for the image in the public storage

            $this->updatePostImageJson($postSlug, $finalImageUrl);

            $content = $post->content;
            $content = str_replace($tempImageUrls[$key], $finalImageUrl, $content);

            $post->content = $content;
        }
        $post->save();


        return redirect('dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // dd($post);
        return view('layouts.blog.show', [
            'post' => $post,
            'title' => $post->metaTitle
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) Storage::delete($post->image);

        $content = json_decode($post->content, true);
        // Extract image URLs from the content
        $imageUrls = [];
        foreach ($content['blocks'] as $block) {
            if ($block['type'] === 'image') {
                $imageUrls[] = $block['data']['file']['url'];
            }
        }

        // Delete the post images from the post-image folder
        foreach ($imageUrls as $imageUrl) {
            $imagePath = str_replace(config('app.url') . '/storage/post-images/', '', $imageUrl);
            $slug = explode('/', $imagePath)[0];
            Storage::delete('post-images/' . $imagePath);

            // Delete the slug subfolder if it's empty
            if (empty(Storage::files('post-images/' . $slug . '/temp-images'))) {
                Storage::deleteDirectory('post-images/' . $slug);
            }
        }

        // Update the post-images.json file to remove the image links associated with the post
        $postImages = json_decode(file_get_contents(storage_path('app/post-images.json')), true);
        unset($postImages[$post->slug]);
        file_put_contents(storage_path('app/post-images.json'), json_encode($postImages, JSON_PRETTY_PRINT));

        Post::destroy($post->id);


        return redirect('dashboard/posts')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    public function cache(Request $request)
    {
        $image = $request->file('image');
        $tempImageName = $image->store('temp-images', 'temp'); // Store the image in the temp storage
        $tempImageUrl = Storage::disk('temp')->url($tempImageName); // Generate the temporary cache URL for the image

        // Store the temporary image name in the session
        $tempImageNames = $request->session()->get('temp_image_names', []); // Retrieve the existing array of temporary image names from the session, default to an empty array if it doesn't exist
        $tempImageNames[] = $tempImageName; // Add the new temporary image name to the array
        $request->session()->put('temp_image_names', $tempImageNames); // Store the updated array back in the session

        // Store the temporary image URL in the session
        $tempImageUrls = $request->session()->get('temp_image_urls', []); // Retrieve the existing array of temporary image URLs from the session, default to an empty array if it doesn't exist
        $tempImageUrls[] = $tempImageUrl; // Add the new temporary image URL to the array
        $request->session()->put('temp_image_urls', $tempImageUrls); // Store the updated array back in the session


        // Return the temporary image URL in the response
        return response()->json(['success' => 1, 'file' => ['url' => $tempImageUrl]]);
    }


    private function updatePostImageJson($postSlug, $imageUrl)
    {
        $jsonFilePath = storage_path('app/post-images.json');
        $postImages = json_decode(file_get_contents($jsonFilePath), true);
        if (!isset($postImages[$postSlug])) {
            $postImages[$postSlug] = [];
        }
        $postImages[$postSlug][] = $imageUrl;
        file_put_contents($jsonFilePath, json_encode($postImages, JSON_PRETTY_PRINT));
    }


    // Function to clean up temporary images
    public function cleanupTemporaryImages()
    {
        $tempImages = Storage::disk('temp')->files('temp-images');
        foreach ($tempImages as $tempImage) {
            $tempImageTimestamp = Storage::disk('temp')->lastModified($tempImage);
            if (time() - $tempImageTimestamp > 60) {
                Storage::disk('temp')->delete($tempImage);
            }
        }
    }
}
