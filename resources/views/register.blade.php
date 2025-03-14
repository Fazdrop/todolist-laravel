@extends('auth.layouts')

@section('title', 'register')

@section('content-form')

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="wrapper bg-white p-4 rounded shadow">

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h2 class="text-center mb-4 text-dark">Register</h2>

            <div class="mb-3">
                <label for="name" class="form-label text-dark">Username</label>
                <input type="text" class="form-control border rounded px-3" id="name" name="name" required value="{{ old('name') }}">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-dark">Email Address</label>
                <input type="email" class="form-control border rounded px-3" id="email" name="email" required value="{{ old('email') }}">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-dark">Password</label>
                <input type="password" class="form-control border rounded px-3" id="password" name="password" required >
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label text-dark">Confirm Password</label>
                <input type="password" class="form-control border rounded px-3" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-dark w-100 py-2">Register</button>

            <div class="text-center mt-3">
                <p class="text-dark">Already have an account? <a href="{{ route('login') }}" class="text-primary">Log in</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
