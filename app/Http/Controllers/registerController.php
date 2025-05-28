<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => ['required', 'in:admin,user'], // Validasi role hanya boleh 'admin' atau 'user'
            'passcode' => 'nullable|string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Password dan konfirmasi password tidak cocok.',
            'password.min' => 'Password harus minimal 8 karakter.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role tidak valid.',
            'passcode.string' => 'Passcode harus berupa string.',
        ]);
        // Validasi khusus passcode untuk admin
        if ($validated['role'] === 'admin' && $request->passcode !== 'B_persediaan') {
            return redirect()->back()->withErrors([
                'passcode' => 'Passcode tidak valid.',
            ])->withInput();
        }

        // Mendaftarkan user baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'], // Ambil role dari input
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman yang sesuai dengan role
        if ($user->role === 'admin') {
            return redirect()->route('admin.index'); // Redirect ke halaman admin jika role adalah admin
        }

        return redirect()->route('user.index'); // Redirect ke halaman user jika role adalah user
    }
}
