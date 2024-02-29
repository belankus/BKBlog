<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TagScheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        if (Auth::user()->hasRole('superadmin')) {
            $tags = Tag::with('posts', 'tagScheme')->get();
        } else {
            $tags = Tag::whereHas('posts', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->get();
        }

        return view('dashboard.tags.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Tag::class);

        $tags = Tag::all();
        $tag_schemes = TagScheme::all();
        return view('dashboard.tags.create', [
            'tags' => $tags,
            'tagSchemes' => $tag_schemes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tag::class);

        $validatedData = $request->validate([
            'name' => 'required|max:20',
            'slug' => 'required|unique:tags,slug',
            'tag_scheme_id' => 'required|exists:tag_schemes,id',
        ], ['tag_scheme_id.required' => 'Please select at least one scheme']);

        Tag::create($validatedData);


        return redirect('dashboard/tags')->with('success', 'New tag has been added!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('edit', $tag);

        $tags = Tag::all();
        $tag_schemes = TagScheme::all();

        return view('dashboard.tags.edit', [
            'tags' => $tags,
            'tag' => $tag,
            'tagSchemes' => $tag_schemes

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $this->authorize('edit', $tag);

        $rules = [
            'name' => 'required|max:20',
            'tag_scheme_id' => 'required|exists:tag_schemes,id',
        ];

        if ($request->input('slug') != $tag->slug) {
            $rules['slug'] = 'required|unique:tags,slug';
        }

        $validatedData = $request->validate($rules);
        Tag::where('id', $tag->id)->update($validatedData);

        return redirect('dashboard/tags')->with('success', 'Tag has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);

        Tag::destroy($tag->id);


        return redirect('dashboard/tags')->with('success', 'Tag has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Tag::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }
}
