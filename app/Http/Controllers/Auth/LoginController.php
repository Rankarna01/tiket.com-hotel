<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // === LOGIN ===
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek Role untuk Redirect
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            // Kalau User biasa, balik ke Home
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // === REGISTER (BARU) ===
    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed', // butuh input name="password_confirmation"
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default user biasa
        ]);

        Auth::login($user); // Auto login setelah daftar

        return redirect()->route('home');
    }

    // === LOGOUT ===
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}