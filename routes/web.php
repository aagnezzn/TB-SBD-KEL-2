<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Course;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CheckoutController;

// Cari baris ini dan tambahkan ->name('course.show') di ujungnya
Route::get('/course/{id}', function ($id) {
    $course = \App\Models\Course::findOrFail($id); 
    return view('course-detail', compact('course'));
})->name('course.show');

Route::get('/berlangganan', function () {
    return view('berlangganan');
});

Route::get('/berlangganan', [FAQController::class, 'index']);

Route::get('/mengajar-di-idemy', function () {
    return view('mengajar');
})->name('mengajar');

Route::get('/keranjang', [CourseController::class, 'index'])->name('keranjang');

Route::get('/login', function() {
    return view ('login');
});

use App\Http\Controllers\AuthController;

use App\Http\Controllers\LoginController;

// Rute untuk menampilkan halaman login (GET)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses data login dari form (POST)
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

use App\Http\Controllers\RegisterController;

// Rute nampilin form daftar
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Rute memproses data pendaftaran
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', function (Request $request) {
    Auth::logout(); // Mengeluarkan user
    $request->session()->invalidate(); // Menghapus sesi
    $request->session()->regenerateToken(); // Mengamankan token CSRF
    
    return redirect('/'); // Mengembalikan user ke halaman utama
})->name('logout');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es', 'id'])) {
        session::put('locale', $locale);
    }
    return redirect()->back(); 
});

Route::get('/category/{slug}', [App\Http\Controllers\CourseController::class, 'filterByCategory'])->name('category.show');

use App\Models\Category;

Route::get('/', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/search', [App\Http\Controllers\CourseController::class, 'search'])->name('search');

Route::post('/cart/add/{course_id}', [CartController::class, 'addToCart'])->name('cart.add')->middleware('auth');

// Rute untuk menghapus item dari keranjang
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove')->middleware('auth');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout')->middleware('auth');
Route::post('/checkout/process', [CheckoutController::class, 'store'])->name('checkout.store');