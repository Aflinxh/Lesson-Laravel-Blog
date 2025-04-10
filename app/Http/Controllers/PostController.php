<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        // if (request('category')) {
        //     $category = Category::firstWhere('slug', request('category'));  
        // }
        // if (request('author')) {
        //     $author = User::firstWhere('username', request('author'));
        // }

        $posts = Post::filter(request(['search', 'category', 'author']))->latest()->paginate(7)->withQueryString();

        return view('posts', [
            'title' => 'Posts',
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        // $post = Post::where('slug', $slug)->first();
        return view('post', [
            'title' => 'Single Post',
            'post' => $post
        ]);
    }

    public function store()
    {
        
        return redirect('/posts');
    }
}