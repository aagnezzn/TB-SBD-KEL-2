<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
{
    if (Auth::check() && Auth::user()->role === 'admin') {
        return $next($request);
    }

    // Jika bukan admin, tendang ke login admin
    return redirect()->route('admin.login')->with('error', 'Akses Admin Ditolak!');
}
}