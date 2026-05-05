<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Course;

Route::get('/course/{id}', function ($id) {
    $course = Course::findOrFail($id); 
    return view('course-detail', compact('course'));
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
})->name('keranjang');

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

Route::get('/', function () {
    // Mengambil kategori induk (Level 1) beserta anak-anaknya (Level 2 & 3)
    $navCategories = \App\Models\Category::whereNull('parent_id')
                        ->with('children.children')
                        ->get();

    // Mengambil 10 data kursus untuk ditampilkan di halaman welcome
    $courses = \App\Models\Course::take(10)->get(); 
    
    return view('welcome', compact('navCategories', 'courses'));
});
Route::get('/search', [App\Http\Controllers\CourseController::class, 'search'])->name('search');