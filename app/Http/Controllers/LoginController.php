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

            // 1. CEK: Apakah dia login lewat portal (Admin/Instructor) atau form utama?
            $lewatPortal = $request->has('from_portal');

            // 2. LOGIKA TENDANG & FEEDBACK: 
            if (!$lewatPortal && in_array($user->role, ['admin', 'instructor'])) {
                $roleUser = $user->role; // Simpan role sebelum logout
                Auth::logout();

                // Pesan custom biar user nggak bingung
                $pesan = ($roleUser === 'admin') 
                    ? 'Akun Admin terdeteksi. Silakan gunakan Portal Login Admin.' 
                    : 'Akun Instruktur terdeteksi. Silakan gunakan Portal Login Instruktur.';

                return redirect()->route('login')->with('error', $pesan);
            }

            // 3. REDIRECT BERDASARKAN ROLE
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