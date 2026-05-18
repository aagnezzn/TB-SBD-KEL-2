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
        // FAKTA PERBAIKAN: Jika yang masuk adalah Admin atau Instruktur, jangan di-logout! 
        // Cukup amankan rute dengan mengarahkan mereka ke rumah (dashboard) mereka masing-masing.
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard')->with('info', 'Anda mendeteksi rute student. Dialihkan otomatis ke Dashboard Admin.');
            }

            if ($role === 'instructor') {
                return redirect()->route('instructor.dashboard')->with('info', 'Anda mendeteksi rute student. Dialihkan otomatis ke Dashboard Instruktur.');
            }
        }

        return $next($request);
    }
}