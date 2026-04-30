<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/berlangganan', function () {
    return view('berlangganan');
});

Route::get('/berlangganan', [FAQController::class, 'index']);