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
    // Jika yang masuk adalah Admin atau Instructor, paksa logout dan suruh pakai portal mereka
    if (Auth::check() && in_array(Auth::user()->role, ['admin', 'instructor'])) {
        Auth::logout();
        return redirect()->route('login')->with('error', 'Gunakan portal login yang benar untuk akun Anda!');
    }

    return $next($request);
}
}
