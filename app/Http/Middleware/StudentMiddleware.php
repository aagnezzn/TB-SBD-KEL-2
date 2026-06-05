<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
{
    // 1. Jika belum login, tendang ke login
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // 2. Jika sudah login, cek rolenya
    $role = Auth::user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard')->with('info', 'Anda Admin, dialihkan ke dashboard.');
    }

    if ($role === 'instructor') {
        return redirect()->route('instructor.dashboard')->with('info', 'Anda Instruktur, dialihkan ke dashboard.');
    }

    // 3. Jika rolenya adalah 'student', baru izinkan akses
    return $next($request);
}
}