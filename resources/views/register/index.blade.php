@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-12 col-lg-4">
            <h1 class="text-center mb-5">Register</h1>
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-floating">
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required value="{{ old('name') }}" autofocus required>
                    <label for="name">Your Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="username" id="username"
                        class="form-control @error('username') is-invalid @enderror" placeholder="Username" required
                        value="{{ old('username') }}">
                    <label for="username">Your Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Email" required
                        value="{{ old('email') }}">
                    <label for="email">Your Email</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                    <label for="password">Your Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-lg mt-3 btn-primary w-100">Register</button>
            </form>
            <small class="d-block text-center mt-3">Already Registered? <a href="/login">Login Now!</a></small>
        </div>
    </div>
@endsection
