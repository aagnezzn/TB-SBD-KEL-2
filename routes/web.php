<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Import Semua Controller 
use App\Http\Controllers\CartController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AccountController;


/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Bebas Akses Tanpa Login)
|--------------------------------------------------------------------------
*/
Route::get('/', [CategoryController::class, 'index']);
Route::get('/search', [CourseController::class, 'search'])->name('search');
Route::get('/category/{id}', [CourseController::class, 'filterByCategory'])->name('category.show');
Route::get('/course/{id}', [CourseController::class, 'show'])->name('course.show');
Route::get('/mengajar-di-idemy', [InstructorController::class, 'showLandingPage'])->name('mengajar');

// Auth Routes (Login/Register tidak boleh pakai middleware verified agar bisa diakses orang baru)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/instructor/login', [InstructorController::class, 'showLogin'])->name('instructor.login');
Route::get('/admin/login', function () { return view('admin.login'); })->name('admin.login');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/')->with('status', 'Email berhasil diverifikasi! Selamat datang di Idemy.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email'); // Pastikan kamu membuat file view ini
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Localization (Multilingual)
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en', 'es'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('change.lang');

/*
|--------------------------------------------------------------------------
| 2. AREA AUTH UMUM (Ditambah 'verified')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{course_id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    Route::get('/buat-kursus', [InstructorController::class, 'createCourse'])->name('instructor.courses.create');
    Route::post('/simpan-kursus', [InstructorController::class, 'storeCourse'])->name('instructor.courses.store');
    Route::get('/konfirmasi-instruktur', [InstructorController::class, 'showConfirmation'])->name('instructor.confirmation');
    Route::post('/upgrade-instructor', [InstructorController::class, 'upgradeRole'])->name('instructor.upgrade');

    Route::get('/pengaturan-akun', [AccountController::class, 'index'])->name('account.index');
    Route::put('/account/profile', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::patch('/account/email', [AccountController::class, 'updateEmail'])->name('account.email.update');
    Route::patch('/account/password', [AccountController::class, 'updatePassword'])->name('account.password.update');
    Route::get('/profil-publik/{id}', [AccountController::class, 'showPublicProfile'])->name('profile.public');
    Route::put('/pengaturan/foto/update', [AccountController::class, 'updatePhoto'])->name('settings.photo.update');
    Route::delete('/account/profile/photo', [AccountController::class, 'deletePhoto'])->name('account.avatar.delete');
});

/*
|--------------------------------------------------------------------------
| 3. AREA SISWA (Ditambah 'verified')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'student', 'verified'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
Route::post('/checkout/confirm/{id}', [CheckoutController::class, 'confirmPayment'])->name('checkout.confirm');
    Route::get('/checkout/invoice/{id}', [CheckoutController::class, 'invoice'])->name('checkout.invoice');
    Route::get('/payment/success/{id}', [CheckoutController::class, 'success'])->name('transaction.success');
    Route::get('/berlangganan', [SubscriptionController::class, 'index'])->name('berlangganan');
    Route::get('/subscribe-now', [SubscriptionController::class, 'startSubscription'])->name('subscribe.start');

    Route::get('/my-learning', [LearningController::class, 'index'])->name('learning.index');
    Route::post('/wishlist/add/{id}', [LearningController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [LearningController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::post('/wishlist/move-to-cart/{id}', [LearningController::class, 'moveToCart'])->name('wishlist.move-to-cart');
    Route::get('/purchase-history', [LearningController::class, 'purchaseHistory'])->name('purchase.history');

    Route::post('/course/{id}/review', [ReviewController::class, 'store'])->name('reviews.store');
});

/*
|--------------------------------------------------------------------------
| 4. AREA INSTRUCTOR (Ditambah 'verified')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'instructor', 'verified'])->prefix('instructor')->group(function () {
    Route::get('/dashboard', [InstructorController::class, 'index'])->name('instructor.dashboard');
    Route::get('/my-courses', [InstructorController::class, 'myCourses'])->name('instructor.courses.index');
    Route::get('/course/{id}/manage', [InstructorController::class, 'manageCourse'])->name('instructor.courses.manage');
    Route::post('/section/{id}/lesson', [InstructorController::class, 'addLesson'])->name('instructor.lessons.store');
    Route::get('/course/{id}/edit', [InstructorController::class, 'editCourse'])->name('instructor.courses.edit');
    Route::put('/course/{id}/update', [InstructorController::class, 'updateCourse'])->name('instructor.courses.update');
    Route::get('/students', [InstructorController::class, 'myStudents'])->name('instructor.students.index');
    Route::get('/performance', [InstructorController::class, 'performance'])->name('instructor.performance');
});

/*
|--------------------------------------------------------------------------
| 5. AREA ADMIN (Ditambah 'verified')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::get('/courses/edit/{id}', [AdminController::class, 'editCourse'])->name('admin.courses.edit');
    Route::put('/courses/update/{id}', [AdminController::class, 'updateCourse'])->name('admin.courses.update');
    Route::delete('/courses/delete/{id}', [AdminController::class, 'deleteCourse'])->name('admin.courses.delete');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/transaksi/{id}', [AdminController::class, 'detailTransaksi'])->name('admin.transaksi.detail');
});