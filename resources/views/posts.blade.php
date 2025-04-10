@extends('layouts.main')

@section('content')
    <h1 class="text-center mb-3">Blog Post</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts" method="GET">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author')) 
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control bg-transparent search" value="{{ request('search') }}" name="search" placeholder="Search..." aria-label="Search...">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                    <a class="btn btn-danger" href="/posts">Clear</a>
                </div>
            </form>
        </div>
    </div>
    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-body text-center">
                <h3 class="card-title">
                    <a href="/posts/{{ $post['slug'] }}" class="text-decoration-none title">{{ $post['title'] }}</a>
                </h3>
                <p class="text-center">
                    <small>
                        By: <a href="/posts?author={{ $post->user->username }}" class="text-decoration-none">{{ $post->user->username }}</a>
                        in
                        <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a>
                    </small>
                </p>
                <p class="card-text">{!!  $post['excerpt'] !!}</p>
                <a href="/posts/{{ $post->slug }}" class="text-decoration-none btn btn-primary">Read More</a>
            </div>
        </div>
    @endforeach
@endsection