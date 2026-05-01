<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Fungsi untuk menampilkan tampilan form login kamu
    public function showLoginForm()
    {
        // Pastikan nama view ini sesuai dengan nama file blade kamu (misal: auth.login atau sekadar login)
        return view('login'); 
    }

    // Fungsi untuk memproses data saat tombol Lanjutkan diklik
    public function login(Request $request)
    {
        // 1. Validasi: Pastikan user mengisi email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Cek ke database: Apakah email dan password cocok?
        if (Auth::attempt($credentials)) {
            // Kalau cocok, buat sesi baru biar aman
            $request->session()->regenerate();
            
            // Arahkan ke halaman utama project kamu ('/')
            return redirect()->intended('/'); 
        }

        // 3. Kalau gagal: Kembalikan ke halaman login dengan pesan error
        return back()->with('error', 'Email atau password salah. Coba lagi.');
    }
}