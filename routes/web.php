<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('home');
    }
    return view('login');
});

Route::get('/home', function () {
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please Log In First');
    }
    return view('home');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'registerUser'])->name('registerUser');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser'])->name('loginUser');

Route::get('/logout', [AuthController::class, 'showlogout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//route untuk postController
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [PostController::class, 'index'])->name('home'); // Menampilkan daftar tugas di home
    Route::post('/home', [PostController::class, 'store'])->name('posts.store'); // Menambah tugas
    Route::put('/home/{post}', [PostController::class, 'update'])->name('posts.update'); // Mengedit tugas
    Route::delete('/home/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // Menghapus tugas
});
Route::patch('/posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])->name('posts.toggleStatus');
