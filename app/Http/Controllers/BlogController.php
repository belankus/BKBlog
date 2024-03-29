<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Collection;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class BlogController extends Controller
{
    public function index()
    {
        // Eager Loading 'with' user model
        $posts = Post::with('user', 'category', 'tags')->where('published', '=', 1)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc')->paginate(10);
        $categories = Category::with(['posts' => function (Builder $query) {
            /** @var \App\Models\Post $query **/
            $query->where('published', '=', 1)->where('published_at', '<=', Carbon::now());
        }])->get();
        $tags = Tag::with('posts', 'tagScheme')->get();

        $post_date = DB::table('posts')
            ->select(DB::raw('YEAR(published_at) AS year, MONTH(published_at) AS month, MONTHNAME(published_at) AS monthname'), DB::raw('count(*) as total'))
            ->where('published', '=', 1)
            ->where('published_at', '<=', Carbon::now())
            ->groupBy('year', 'monthname', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        $post_year = DB::table('posts')
            ->select(DB::raw('YEAR(published_at) AS year'), DB::raw('count(*) as total'))
            ->where('published', '=', 1)
            ->where('published_at', '<=', Carbon::now())
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

        $comments = Comment::with('user')
            ->where('post_id', '=', $singlePost->id)
            ->where('published', '=', 1)
            ->orderBy('updated_at', 'ASC')
            ->get();

        $user = User::with('comments')->get();

        $replies = [];
        foreach ($comments as $c1) {
            if ($c1->parent_id == 0) {
                $commentOriginal[] = $c1;
            }
            foreach ($comments as $c2) {
                if ($c1->id == $c2->parent_id) {
                    $replies[] = $c2;
                }
            }
        }


        $singlePost = Post::with('user', 'category', 'tags')->where('slug', '=', $singlePost->slug)->where('published', '=', 1)->where('published_at', '<=', Carbon::now())->firstorFail();

        return view('layouts.blog.show', [
            'title' => $singlePost->category->name . ' - ' . ($singlePost->metaTitle ?? $singlePost->title),
            'singlePost' => $singlePost,
            'comments' => $commentOriginal ?? [],
            'replies' => $replies ?? [],
            'users' => $user,
            'oriComments' => $comments ?? []
        ]);
    }

    public function tahun($year)
    {
        $RAW = Post::with('category', 'user', 'tags')->select(DB::raw('*'))->whereRaw("published_at BETWEEN '$year-01-01 00:00:00' AND '$year-12-31 23:59:59'")->whereRaw("published = 1")->whereRaw("published_at <= NOW()")->orderBy('published_at', 'desc');
        $check = $RAW->firstorFail();
        $getRows = $RAW->paginate(10);


        return view('layouts.blog.showcase', [
            'getRows' => $getRows,
            'title' => $year . ' Archive',
            'year' => $year
        ]);
    }

    /* Retrieve archive of Year and Month */
    public function bulan($tahun, $bulan)
    {
        try {
            if ($bulan) {
                $month = Carbon::parse($bulan)->format('m');
            }
        } catch (Throwable $e) {
            abort(404);
        }
        $getRows = Post::with('category', 'user', 'tags')->select(DB::raw('*'))->whereRaw("YEAR(published_at) =" . $tahun . " AND MONTH(published_at) =" . $month)->whereRaw("published = 1")->whereRaw("published_at <= NOW()")->orderBy('published_at', 'desc')->paginate(10);
        return view('layouts.blog.showcase', [
            'getRows' => $getRows,
            'title' => ucfirst($bulan) . ' ' . $tahun . ' Archive',
            'year' => $tahun . ' - ' . ucfirst($bulan)
        ]);
    }

    public function category(Category $category)
    {
        $posts = Post::with('user', 'category', 'tags')->where('category_id', '=', $category->id)->where('published', '=', 1)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc')->paginate(10);

        return view('layouts.blog.category', [

            'title' => $category->name,
            'posts' => $posts
        ]);
    }

    public function tag(Tag $tag)
    {
        // $id = [$tag->id];
        // $posts = Post::with('user', 'category', 'tags')->where('published', '=', 1)->where(function ($query) use ($id) {
        //     foreach ($id as $value) {
        //         $query->whereHas('tags', function ($query) use ($value) {
        //             $query->where('tag_id', $value);
        //         });
        //     }
        // })->paginate(10);

        $slug = $tag->slug;
        $posts = Post::with('user', 'category', 'tags')->where('published', '=', 1)->where('published_at', '<=', Carbon::now())->whereHas('tags', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('layouts.blog.tag', [

            'title' => $tag->name,
            'posts' => $posts
        ]);
    }
}
