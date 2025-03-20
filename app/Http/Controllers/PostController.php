<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('blog', [
            'title' => 'Blog',
            'posts' => $posts
        ]);
    }

    public function store()
    {
        return redirect('/blog');
    }
}