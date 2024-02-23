<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $post = Post::where('published', '=', 1)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc')->first();
        return view('home', [
            'title' => 'Home Page | BKA Blog',
            'latestPost' => $post,
        ]);
    }
}
