<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Support\Collection;

class BlogController extends Controller
{
    public function index()
    {
        // Eager Loading 'with' user model
        $posts = Post::with('user', 'category', 'tags')->where('published', '=', 1)->paginate(10);
        $categories = Category::with(['posts' => function (Builder $query) {
            /** @var \App\Models\Post $query **/
            $query->where('published', '=', 1);
        }])->get();
        $tags = Tag::with('posts')->get();
        return view('blog', [
            'title' => 'Blog | BKA Blog',
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function show(Post $year, $slug)
    {
        /**Get Model From RouteServiceProvider.php
         * 
         * Bind 2 columns on URL
         */

        $singlePost = $GLOBALS['singlePost'];
        return view('layouts.blog.show', [
            'title' => $singlePost->metaTitle,
        ]);
    }
}
