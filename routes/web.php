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

Route::get('/mengajar-di-idemy', function () {
    return view('mengajar');
})->name('mengajar');

Route::get('/keranjang', function () {
    return view('keranjang');
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
});