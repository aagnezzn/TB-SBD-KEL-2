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

    // Cek jika user yang login memiliki role admin atau instructor
    if (in_array(Auth::user()->role, ['admin', 'instructor'])) {
    
    // Logout kembali user tersebut agar session tidak tersimpan
    Auth::logout();

    // Redirect balik ke halaman login dengan pesan error
    return redirect()->route('login')->with('error', 'Admin dan Instructor tidak bisa login di sini. Silakan gunakan link khusus di bawah.');
}

        // Jika siswa, lempar ke homepage utama
        return redirect()->intended('/'); 
    }

    // 3. Jika gagal
    return back()->with('error', 'Email atau password salah.');
}
}