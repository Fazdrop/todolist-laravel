@extends('auth.layouts')

@section('title', 'Login')

@section('content-form')

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="wrapper bg-white p-4 rounded shadow">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2 class="text-center mb-4 text-dark">Login</h2>

            {{-- Menampilkan error jika login gagal --}}
            @if (session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Input Email --}}
            <div class="mb-3">
                <label for="email" class="form-label text-dark">Email Address</label>
                <input type="email" class="form-control border rounded px-3"
                       id="email" name="email" required value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger error-message" id="emailError">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Password --}}
            <div class="mb-3 position-relative">
                <label for="password" class="form-label text-dark">Password</label>
                <div class="position-relative">
                    <input type="password" class="form-control border rounded px-3 pe-5"
                           id="password" name="password" required>
                    <button class="btn position-absolute end-0 top-50 translate-middle-y me-2 border-0 bg-transparent"
                            type="button" onclick="togglePassword('password', 'eyesIcon')">
                        <i class="bi bi-eye-slash" id="eyesIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger error-message" id="passwordError">{{ $message }}</div>
                @enderror
            </div>

            {{-- Checkbox Remember Me --}}
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme">
                <label class="form-check-label text-dark" for="rememberme">Remember me</label>
            </div>

            {{-- Tombol Login --}}
            <button type="submit" class="btn btn-dark w-100 py-2">Log In</button>

            {{-- Link ke halaman register --}}
            <div class="text-center mt-3">
                <p class="text-dark">Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register</a></p>
            </div>
        </form>
    </div>
</div>

@endsection
