@extends('auth.layouts')

@section('title', 'Register')

@section('content-form')

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="wrapper bg-white p-4 rounded shadow">

        {{-- Menampilkan pesan sukses jika registrasi berhasil --}}
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h2 class="text-center mb-4 text-dark">Register</h2>

            {{-- Input Username --}}
            <div class="mb-3">
                <label for="name" class="form-label text-dark">Username</label>
                <input type="text" class="form-control border rounded px-3"
                       id="name" name="name" required
                       value="{{ old('name') }}">
                @error('name')
                <div class="text-danger error-message" id="nameError">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Email --}}
            <div class="mb-3">
                <label for="email" class="form-label text-dark">Email Address</label>
                <input type="email" class="form-control border rounded px-3"
                       id="email" name="email" required
                       value="{{ old('email') }}">
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
                            type="button" onclick="togglePassword('password', 'togglePasswordIcon')">
                        <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                    </button>
                </div>
                @error('password')
                <div class="text-danger error-message" id="passwordError">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Confirm Password --}}
            <div class="mb-3 position-relative">
                <label for="password_confirmation" class="form-label text-dark">Confirm Password</label>
                <div class="position-relative">
                    <input type="password" class="form-control border rounded px-3 pe-5"
                           id="password_confirmation" name="password_confirmation" required>
                    <button class="btn position-absolute end-0 top-50 translate-middle-y me-2 border-0 bg-transparent"
                            type="button" onclick="togglePassword('password_confirmation', 'toggleConfirmPasswordIcon')">
                        <i class="bi bi-eye-slash" id="toggleConfirmPasswordIcon"></i>
                    </button>
                </div>
                @error('password_confirmation')
                <div class="text-danger error-message" id="passwordConfirmError">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-dark w-100 py-2">Register</button>

            <div class="text-center mt-3">
                <p class="text-dark">Already have an account? <a href="{{ route('login') }}" class="text-primary">Log in</a></p>
            </div>
        </form>
    </div>
</div>

@endsection
