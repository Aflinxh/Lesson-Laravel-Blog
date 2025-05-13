@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>{{ $post->title }}</h2>
            <p class="">
                <small>
                    By: <a href="/posts?author={{ $post->user->name }}" class="text-decoration-none">{{ $post->user->name }}</a>
                </small>
            </p>

            <div class="" style="max-height: 400px; overflow:hidden">
                <img src="{{ asset('storage/' . $post->image) }}" alt="" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
            </div>
            
            <article class="my-3">
                {!! $post->body !!}
            </article>

            <a href="/posts">Back to Posts</a>
        </div>
    </div>

@endsection
