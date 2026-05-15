<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // 1. Ambil data asal portal (dari hidden input di Blade)
            $lewatPortal = $request->has('from_portal');
            $tipePortal = $request->input('portal_type'); // 'admin' atau 'instructor'

            // 2. PROTEKSI PORTAL ADMIN: Jika di laman Admin tapi bukan akun Admin
            if ($lewatPortal && $tipePortal === 'admin' && $user->role !== 'admin') {
                Auth::logout();
                return redirect()->route('admin.login')->with('error', 'Akses Ditolak! Ini portal khusus Admin.');
            }

            // 3. PROTEKSI PORTAL INSTRUCTOR: Jika di laman Instructor tapi bukan akun Instructor
            if ($lewatPortal && $tipePortal === 'instructor' && $user->role !== 'instructor') {
                Auth::logout();
                return redirect()->route('instructor.login')->with('error', 'Akses Ditolak! Ini portal khusus Instruktur.');
            }

            // 4. PROTEKSI LAMAN DEPAN: Admin & Instructor tidak boleh login di form siswa umum
            if (!$lewatPortal && in_array($user->role, ['admin', 'instructor'])) {
                $roleUser = $user->role;
                Auth::logout();

                $pesan = ($roleUser === 'admin') 
                    ? 'Akun Admin terdeteksi. Silakan gunakan Portal Login Admin.' 
                    : 'Akun Instruktur terdeteksi. Silakan gunakan Portal Login Instruktur.';

                return redirect()->route('login')->with('error', $pesan);
            }

            // 5. REDIRECT AKHIR (Jika semua validasi lolos)
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