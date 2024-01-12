<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        return view('blog',[
            'title' => 'Blog | BKA Blog'
        ]);
    }

    public function show() {
        return view('layouts.blog.show',[
            'title' => 'Blog Show | BKA Blog'
        ]);
    }
}
