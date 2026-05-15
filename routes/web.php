<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Import Controllers
use App\Http\Controllers\FAQController;
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
Route::get('/category/{slug}', [CourseController::class, 'filterByCategory'])->name('category.show');

Route::get('/course/{id}', function ($id) {
    $course = \App\Models\Course::findOrFail($id); 
    return view('course-detail', compact('course'));
})->name('course.show');

Route::get('/berlangganan', [FAQController::class, 'index']);
Route::get('/mengajar-di-idemy', function () {
    return view('mengajar');
})->name('mengajar');

// Auth Routes
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

// Localization
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en', 'es'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('change.lang');

/*
|--------------------------------------------------------------------------
| 2. AREA AUTH UMUM (Hanya Butuh Login)
|--------------------------------------------------------------------------
| Di sini tempat rute yang bisa diakses baik oleh Student maupun Instructor.
*/
Route::middleware(['auth'])->group(function () {
    // Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{course_id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // JEMBATAN INSTRUKTUR (PENTING: Jangan masukkan ke middleware 'instructor' agar Siswa bisa daftar)
    Route::get('/buat-kursus', [InstructorController::class, 'createCourse'])->name('instructor.courses.create');
    Route::post('/simpan-kursus', [InstructorController::class, 'storeCourse'])->name('instructor.courses.store');
    Route::get('/konfirmasi-instruktur', [InstructorController::class, 'showConfirmation'])->name('instructor.confirmation');
    Route::post('/upgrade-instructor', [InstructorController::class, 'upgradeRole'])->name('instructor.upgrade');

    // Pengaturan Akun
    Route::get('/pengaturan-akun', [AccountController::class, 'index'])->name('account.settings');
    Route::put('/account/profile', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::patch('/account/email', [AccountController::class, 'updateEmail'])->name('account.email.update');
    Route::patch('/account/password', [AccountController::class, 'updatePassword'])->name('account.password.update');
});

/*
|--------------------------------------------------------------------------
| 3. AREA SISWA (Middleware 'student')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/invoice/{id}', [CheckoutController::class, 'invoice'])->name('checkout.invoice');
    Route::get('/payment/success/{id}', [CheckoutController::class, 'success'])->name('transaction.success');
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
| 4. AREA INSTRUCTOR (Middleware 'instructor')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'instructor'])->prefix('instructor')->group(function () {
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
| 5. AREA ADMIN (Middleware 'admin')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::get('/courses/edit/{id}', [AdminController::class, 'editCourse'])->name('admin.courses.edit');
    Route::put('/courses/update/{id}', [AdminController::class, 'updateCourse'])->name('admin.courses.update');
    Route::delete('/courses/delete/{id}', [AdminController::class, 'deleteCourse'])->name('admin.courses.delete');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

});

Route::middleware('auth')->group(function () {
    Route::get('/pengaturan-akun', [AccountController::class, 'index'])->name('account.settings');
    Route::put('/pengaturan-akun', [AccountController::class, 'update'])->name('account.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/pengaturan-akun', [AccountController::class, 'index'])->name('account.settings');
    Route::put('/account/profile', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::patch('/account/email', [AccountController::class, 'updateEmail'])->name('account.email.update');
    Route::patch('/account/password', [AccountController::class, 'updatePassword'])->name('account.password.update');
    Route::get('/profil-publik/{id}', [AccountController::class, 'showPublicProfile'])->name('profile.public');
});



