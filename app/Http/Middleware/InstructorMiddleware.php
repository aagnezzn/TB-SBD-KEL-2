<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 

class InstructorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    if (Auth::check() && Auth::user()->role === 'instructor') {
        return $next($request);
    }
    // Arahkan ke login utama
    return redirect()->route('login')->with('error', 'Akses Instruktur Ditolak!');
}
}
