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
    // 1. Validasi input
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // 2. Cek apakah email & password benar
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // --- INI KUNCINYA ---
        // Jika yang login adalah admin, lempar ke dashboard admin
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard'); 
        }

        // Jika siswa, lempar ke homepage utama
        return redirect()->intended('/'); 
    }

    // 3. Jika gagal
    return back()->with('error', 'Email atau password salah.');
}
}