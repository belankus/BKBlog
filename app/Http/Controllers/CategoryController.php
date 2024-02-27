<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        if (Auth::user()->hasRole('superadmin')) {
            $categories = Category::with('posts')->get();
        } else {
            $categories = Category::with(['posts' => function ($query) {
                $query->where('user_id', Auth::user()->id);
            }])->whereHas('posts', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->get();
        }

        return view('dashboard.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        $categories = Category::all();
        return view('dashboard.categories.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $validatedData = $request->validate([
            'name' => 'required|max:20',
            'slug' => 'required|unique:categories,slug',
            'icon' => 'nullable',
        ]);

        if ($request->input('parent_id') != null) {
            $request->validate(['parent_id' => 'exists:categories,id']);
            $validatedData['parent_id'] = $request->input('parent_id');
        } elseif ($request->input('parent_id') == null) {
            $validatedData['parent_id'] = 0;
        };


        Category::create($validatedData);

        return redirect('dashboard/categories')->with('success', 'New category has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('edit', $category);
        $categories = Category::all();

        return view('dashboard.categories.edit', [
            'categories' => $categories,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('edit', $category);

        $rules = [
            'name' => 'required|max:20',
            'icon' => 'nullable',
        ];

        if ($request->input('slug') != $category->slug) {
            $rules['slug'] = 'required|unique:categories,slug';
        }

        if ($request->input('parent_id') != $category->parent_id) {
            $rules['parent_id'] = 'exists:categories,id';
        }

        $validatedData = $request->validate($rules);
        Category::where('id', $category->id)->update($validatedData);

        return redirect('dashboard/categories')->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        Category::destroy($category->id);


        return redirect('dashboard/categories')->with('success', 'Category has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }
}
