<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial dan autentikasi pengguna
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan peran pengguna
            $role = Auth::user()->role; // Ambil peran user dari tabel 'users'
            if ($role === 'admin') {
                return redirect()->route('admin.index'); // Halaman khusus admin
            } elseif ($role === 'user') {
                return redirect()->route('user.index'); // Halaman khusus user
            }
        }

        // Kalau gagal login
        return redirect()->route('login')->with('error', 'Email atau password salah.');
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
