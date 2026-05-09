<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // TAMBAHKAN INI

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
{
    // 1. Jika user sudah login dan perannya adalah admin, izinkan lanjut
    if (Auth::check() && Auth::user()->role === 'admin') {
        return $next($request);
    }

    // 2. PENGECUALIAN: Jika user sedang mengakses halaman login admin, jangan di-redirect lagi
    // Ini adalah kunci agar tidak terjadi ERR_TOO_MANY_REDIRECTS
    if ($request->routeIs('admin.login')) {
        return $next($request);
    }

    // 3. Jika bukan admin atau belum login, arahkan ke rute login khusus admin
    return redirect()->route('admin.login')->with('error', 'Khusus halaman Admin!');
}
}