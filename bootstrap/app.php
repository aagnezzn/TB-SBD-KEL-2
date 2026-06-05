<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // MENDAFTARKAN MIDDLEWARE SETLOCALE
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        // MENDAFTARKAN MIDDLEWARE ADMIN
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'instructor' => \App\Http\Middleware\InstructorMiddleware::class,
            'student' => \App\Http\Middleware\StudentMiddleware::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

        