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
use App\Http\Controllers\AdminController;

// Cari baris ini dan tambahkan ->name('course.show') di ujungnya
Route::get('/course/{id}', function ($id) {
    $course = \App\Models\Course::findOrFail($id); 
    return view('course-detail', compact('course'));
})->name('course.show');

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
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove')->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');

// --- ROUTE UNTUK CHECKOUT & PEMBAYARAN ---

// 1. Nampilin halaman checkout (keranjang)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout')->middleware('auth');

// 2. Memproses form saat tombol 'Selesaikan Pembayaran' diklik
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');

// 3. Nampilin halaman Invoice (QR Code)
Route::get('/checkout/invoice/{id}', [CheckoutController::class, 'invoice'])->name('checkout.invoice');

// 4. Nampilin halaman Pembayaran Berhasil
Route::get('/payment/success/{id}', [CheckoutController::class, 'success'])->name('transaction.success');


Route::get('/admin/login', function () {return view('admin.login');})->name('admin.login');

// Lebih rapi karena pakai alias 'admin'
Route::middleware(['admin'])->group(function () {
    
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::get('/admin/courses/create', [AdminController::class, 'createCourse'])->name('admin.courses.create');
    Route::post('/admin/courses/store', [AdminController::class, 'storeCourse'])->name('admin.courses.store');
    Route::get('/admin/courses/edit/{id}', [AdminController::class, 'editCourse'])->name('admin.courses.edit');
    Route::put('/admin/courses/update/{id}', [AdminController::class, 'updateCourse'])->name('admin.courses.update');
    Route::delete('/admin/courses/delete/{id}', [AdminController::class, 'deleteCourse'])->name('admin.courses.delete');
    Route::get('/admin/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    
});

// Route untuk menampilkan halaman success yang kamu buat di awal
Route::get('/payment/success/{id}', [TransactionController::class, 'success'])->name('transaction.success');

