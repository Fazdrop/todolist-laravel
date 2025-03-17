<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // Menampilkan form register
    public function showRegisterForm()
    {
        //menangani user yang ketika sudah register dan direct ke halaman register
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('register');
    }

    // Logic register
    public function registerUser(Request $request):RedirectResponse
    {
        $request->validate([
            'name' => ['required','string','max:255', 'unique:users'],
            'email' => ['required','string','email','max:255'],
            'password' => ['required','string','confirmed']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registration successful.');
    }

    // Menampilkan halaman login
    public function showLoginForm()
    {
        //menangani user ketika sudah login namun direct ke halaman login
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('login');
    }

    // Menangani proses login
    public function loginUser(Request $request):RedirectResponse
    {
        $credential = $request->validate([
            'email' => ['required','email'],
            'password' =>['required']
        ]);

        //menangani user yang sudah login
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Login successful.');
        }
        //mengembalikan error jika user salah mengisi email dan/password
        return back()->withErrors(['email' => 'Invalid email or password.'])->onlyInput('email');
    }

    public function showlogout()
    {
        return abort(403);
    }
    // Menangani proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
