@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Update Post</h2>
    </div>

    <div class="col-lg-8">
        <form action="{{ route('dashboard.posts.update', $post->slug) }}" method="POST" class="mb-5" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $post->title) }}" required autofocus>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                <input type="hidden" name="oldImage" value="{{ $post->image }}">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="" class="img-preview img-fluid mb-3 col-sm-5 d-block" id="image-preview">
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                    accept="image/*" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                <trix-editor input="body"></trix-editor>
                @error('body')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        function previewImage() {
            
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('#image-preview');

            imgPreview.classList.remove('d-none');
            imgPreview.classList.add('d-block');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush