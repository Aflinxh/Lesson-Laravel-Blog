@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-12 col-lg-4">

            <h1 class="text-center mb-5">Login</h1>

            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session()->has('loginError'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('loginError') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <small class="d-block text-center mt-3">Not Registered? <a href="/register">Register Now!</a></small>

        </div>
    </div>
@endsection
