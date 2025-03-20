@extends('layouts.main')

@section('content')
    <h1>Blog Post</h1>

    @foreach ($posts as $post)
        <article class="mb-5">
            <h2>{{ $post['title'] }}</h2>
            <h5>By: {{ $post['author'] }}</h5>
            <p>{{ $post['body'] }}</p>
        </article>
    @endforeach

@endsection
