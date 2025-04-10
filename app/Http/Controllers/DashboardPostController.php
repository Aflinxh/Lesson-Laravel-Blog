<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardPostController extends Controller
{
    
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->latest()->paginate(10)->withQueryString();
        return view('dashboard.posts.index', [
            'posts' => $posts,
            'title' => 'My Posts'
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create', [
            'title' => 'Create New Post',
            'categories' => $categories,
        ]);
    }

    public function edit()
    {
        return view('dashboard.posts.edit', [
            'title' => 'Edit Post'
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:5024',
            'body' => 'required',
        ]);

        $validatedData['slug'] = str_replace(' ', '-', strtolower($validatedData['title']));
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = str()->limit(strip_tags($validatedData['body']), 200);

        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post has been created!');
    }

    public function update()
    {
        return redirect('/dashboard/posts');
    }

    public function destroy()
    {
        return redirect('/dashboard/posts');
    }


}
