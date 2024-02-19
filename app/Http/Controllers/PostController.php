<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    public function create()
    {
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
        $imageName = $image->store('temp-images', 'public'); // Store the image in a temporary location
        $imageUrl = asset('storage/' . $imageName); // Generate the temporary cache URL for the image

        return response()->json(['success' => 1, 'file' => ['url' => $imageUrl]]);
    }
}
