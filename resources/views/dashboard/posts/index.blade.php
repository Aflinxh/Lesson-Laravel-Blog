@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">{{ auth()->user()->name }}'s posts</h2>
    </div>

    <div class="table-responsive">
        <a href="{{ route('dashboard.posts.create') }}" class="btn btn-primary mb-3">Create</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <td scope="col">Category</td>
                    <th scope="col">Created At</th>
                    <th scope="col">Last Update</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('dashboard.posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dashboard.posts.destroy', $post) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $posts->links() }}
    </div>
@endsection