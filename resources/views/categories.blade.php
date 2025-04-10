@extends('layouts.main')

@section('content')
    <h1>Post Categories</h1>

    <div class="container">
        <div class="row mt-3">
            @foreach ($categories as $category)
                <div class="col-md-4 mb-3">
                    <a href="/posts?category={{ $category->slug }}">
                        <div class="card text-bg-dark">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSmatSr3THeYjp_SWNMu8UFfMQFQURGi87UQ&s" alt="" class="card-img">
                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title text-center flex-fill p-4" style="background-color: rgba(0, 0, 0, 0.7)">{{ $category->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
