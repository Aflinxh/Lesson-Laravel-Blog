<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'title' => 'Edit Post',
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    public function store(StorePostRequest $request)
    {
        // dd($request->all());

        $request['slug'] = str_replace(' ', '-', strtolower($request['title']));
        if ($request->file('image')) {
            $request['image'] = $request->file('image')->store('post-images');
        }

        $request['user_id'] = auth()->user()->id;
        $request['excerpt'] = str()->limit(strip_tags($request['body']), 200);
        $request['created_at'] = now();
        $request['updated_at'] = now();

        Post::create($request->toArray());

        return redirect('/dashboard/posts')->with('success', 'New post has been created!');
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = [];
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['image'] = $request->file('image')->store('post-images');
        }
        if ($request->title != $post->title) {
            $data['slug'] = str_replace(' ', '-', strtolower($request['title']));
        }
        
        $data['title'] = $request['title'];
        $data['category_id'] = $request['category_id'];
        $data['body'] = $request['body'];
        $data['user_id'] = auth()->user()->id;
        $data['excerpt'] = str()->limit(strip_tags($request['body']), 200);
        $data['updated_at'] = now();

        // dd($data);

        Post::where('id', $post->id)->update($data);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image);
        }

        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }


}
