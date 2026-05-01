<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Panggil model User buat insert data
use Illuminate\Support\Facades\Auth; // Panggil Auth buat auto-login
use Illuminate\Support\Facades\Hash; // Panggil Hash buat enkripsi password

class RegisterController extends Controller
{
    // 1. Nampilin form pendaftaran
    public function showRegistrationForm()
    {
        return view('register'); // Arahin ke file register.blade.php
    }

    // 2. Proses simpan data ke database
    public function register(Request $request)
    {
        // Validasi: Pastikan nama diisi, email harus valid dan belum pernah dipakai (unique), password minimal 8 huruf
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', 
        ], [
            // Pesan error custom biar bahasa Indonesia
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain atau login.',
            'password.min' => 'Password minimal harus 8 karakter.'
        ]);

        // Masukin data ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // WAJIB PAKE HASH! Password gak boleh disimpen telanjang.
        ]);

        // Biar user gak usah login manual lagi habis daftar, kita auto-login
        Auth::login($user);

        // Arahkan ke halaman utama
        return redirect()->intended('/');
    }
}