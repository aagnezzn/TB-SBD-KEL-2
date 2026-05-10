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
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // 1. CEK: Apakah dia bawa "Kunci" dari portal khusus?
        $lewatPortal = $request->has('from_portal');

        // 2. LOGIKA TENDANG: 
        // Jika Admin/Instructor masuk dari FORM UTAMA (tanpa kunci from_portal)
        if (!$lewatPortal && in_array($user->role, ['admin', 'instructor'])) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Portal ini khusus Siswa. Silakan gunakan link di bawah!');
        }

        // 3. REDIRECT LANGSUNG (Tanpa dicampak lagi)
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } 
        
        if ($user->role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        }

        return redirect()->intended('/'); 
    }

    return back()->with('error', 'Email atau password salah.');
}
}