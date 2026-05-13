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
     *
     * @param  Closure(Request): (Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
{
    if (Auth::check() && in_array(Auth::user()->role, ['admin', 'instructor'])) {
        $role = Auth::user()->role;
        Auth::logout();

        // Memberikan pesan spesifik berdasarkan role mereka
        $pesan = ($role === 'admin') 
            ? 'Akun Admin tidak bisa login di sini. Silakan gunakan Portal Admin.' 
            : 'Akun Instruktur tidak bisa login di sini. Silakan gunakan Portal Instruktur.';

        return redirect()->route('login')->with('error', $pesan);
    }

    return $next($request);
}
}
