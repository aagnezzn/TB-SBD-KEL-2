<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\User;

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
            $user = Auth::user();

            // KEAMANAN: Cek apakah akun disuspend
            if ($user->is_suspended) {
                Auth::logout();
                return back()->with('error', 'Akun Anda sedang disuspend.');
            }

            $request->session()->regenerate();

            // SELEKSI ROLE (Satu pintu masuk)
            return match ($user->role) {
                'admin'      => redirect()->intended('/admin/dashboard'),
                'instructor' => redirect()->intended('/instructor/dashboard'),
                default      => redirect()->intended('/'),
            };
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function showLinkRequestForm()
{
    return view('auth.forgot-password');
}

   public function sendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);

    // Menggunakan sistem bawaan Laravel untuk mengirim link reset
    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with('success', 'Tautan reset password telah dikirim ke email Anda.')
        : back()->with('error', 'Gagal mengirim tautan reset password.');
}

public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill(['password' => bcrypt($password)])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect('/login')->with('success', 'Password berhasil diubah! Silakan login kembali.')
        : back()->with('error', 'Token reset tidak valid atau sudah kedaluwarsa.');
}
}