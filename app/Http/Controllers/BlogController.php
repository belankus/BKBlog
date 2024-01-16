<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;
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

        $post_date = DB::table('posts')
            ->select(DB::raw('YEAR(published_at) AS year, MONTH(published_at) AS month, MONTHNAME(published_at) AS monthname'), DB::raw('count(*) as total'))
            ->where('published', '=', 1)
            ->groupBy('year', 'monthname', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        $post_year = DB::table('posts')
            ->select(DB::raw('YEAR(published_at) AS year'), DB::raw('count(*) as total'))
            ->where('published', '=', 1)
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        // $year = $post_year->select(DB::raw('year'), DB::raw('count(*) as totalYear'))->groupBy('year');
        // dd($post_year);
        return view('blog', [
            'title' => 'Blog | BKA Blog',
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'dates' => $post_date,
            'years' => $post_year,
            // 'countDate' => $post_dateD
        ]);
    }

    public function show($singlePost)
    {
        /**Get Model From RouteServiceProvider.php
         * 
         * Bind 2 columns on URL
         */

        return view('layouts.blog.show', [
            'title' => $singlePost->metaTitle,
        ]);
    }

    public function tahun($year)
    {
        // dd($year);
        return view('layouts.blog.showcase', [
            'getRows' => $year[0],
            'title' => $year[1] . ' Archive',
            'year' => $year[1]
        ]);
    }
}
