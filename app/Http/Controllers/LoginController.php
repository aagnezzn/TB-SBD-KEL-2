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

                //Ambil data asal portal (dari hidden input di Blade)
                $lewatPortal = $request->has('from_portal');
                $tipePortal = $request->input('portal_type'); // 'admin' atau 'instructor'

            // kalo yang masuk bukan admin
            if ($lewatPortal && $tipePortal === 'admin' && $user->role !== 'admin') {
                Auth::logout();
                return redirect()->route('admin.login')->with('error', 'Akses Ditolak! Ini portal khusus Admin.');
            }

            // kalo yg masuk bukan akun instructor
            if ($lewatPortal && $tipePortal === 'instructor' && $user->role !== 'instructor') {
                Auth::logout();
                return redirect()->route('instructor.login')->with('error', 'Akses Ditolak! Ini portal khusus Instruktur.');
            }

            // admin dan instructor ga bisa masuk dari laman utama
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