<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    // 1. Redirect user ke halaman login Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Handle callback dari Google
    public function callback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah ada di database (berdasarkan google_id atau email)
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if ($user) {
                // Skenario 1: User sudah ada -> Update ID & Login
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
                
                Auth::login($user);
                
            } else {
                // Skenario 2: User baru -> Buat Akun & Login
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(Str::random(16)), // Password random
                    'role' => 'user', // Default role
                ]);

                Auth::login($newUser);
            }

            // Redirect ke Home setelah login sukses
            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login dengan Google.');
        }
    }
}