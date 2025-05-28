<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class profileController extends Controller
{
    /**
     * Display the profile of the logged-in user.
     */
    public function index()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Show the form for editing the logged-in user's profile.
     */
    public function edit()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the profile of the logged-in user.
     */
    public function update(Request $request)
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update nama dan email pengguna
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Jika ada file gambar yang diunggah
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_image', 'public');
            $user->profile_image = $path;
        }

        $user->save(); // Simpan perubahan ke database

        return redirect()->route('admin.profile.index')->with('success', 'Profile updated successfully.');
    }
}
