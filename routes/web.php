<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Promo;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ====================================================
// 1. AUTHENTICATION ROUTES (Login Admin)
// ====================================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);
// Register Routes
Route::get('/register', [App\Http\Controllers\Auth\LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\LoginController::class, 'register'])->name('register.post');

// ====================================================
// 2. ADMIN ROUTES (Protected by Auth Middleware)
// ====================================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('locations', App\Http\Controllers\Admin\LocationController::class);
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Dashboard (Sekaligus List Hotel & CRUD Modal Hotel)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('sections', SectionController::class);
    Route::resource('inspirations', App\Http\Controllers\Admin\InspirationController::class);
    // Proses Tambah & Hapus Hotel
    Route::post('/hotels', [DashboardController::class, 'store'])->name('hotels.store');
    Route::delete('/hotels/{hotel}', [DashboardController::class, 'destroy'])->name('hotels.destroy');
    Route::resource('partners', App\Http\Controllers\Admin\PartnerController::class);
    // Manajemen Promo (Resource Controller)
    Route::resource('promos', PromoController::class);
    Route::get('/transactions', [App\Http\Controllers\Admin\ReportController::class, 'transactions'])->name('transactions');
    Route::get('/users', [App\Http\Controllers\Admin\ReportController::class, 'users'])->name('users');
    Route::get('/income', [App\Http\Controllers\Admin\ReportController::class, 'income'])->name('income');
});


// ====================================================
// 3. PUBLIC ROUTES (User Frontend)
// ====================================================

// Halaman Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cari-hotel', [HomeController::class, 'search'])->name('hotels.list');
Route::get('/hotel/{slug}/book', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::get('/hotel/{slug}/book/addons', [BookingController::class, 'checkoutAddons'])->name('booking.addons');
Route::post('/midtrans/callback', [App\Http\Controllers\CallbackController::class, 'handle']);
Route::post('/booking/process', [App\Http\Controllers\BookingController::class, 'processPayment'])->name('booking.process');
Route::middleware(['auth'])->group(function () {
    Route::get('/history', [BookingController::class, 'history'])->name('history');
});
Route::get('/booking/success', [BookingController::class, 'paymentSuccess'])->name('booking.success');
// Route Detail Lokasi
Route::get('/destinasi/{slug}', [HomeController::class, 'locationDetail'])->name('location.detail');
// Halaman Detail Hotel (Slug dinamis)
// Pastikan ejaannya 'hotelDetail' (tanpa 's', huruf D besar)
Route::get('/hotel/{slug}', [HomeController::class, 'hotelDetail'])->name('hotel.detail');
// Route::get('/hotel/{slug}', [HomeController::class, '
// hotelDetail'])->name('hotel.detail');
Route::get('/partner/{slug}', [App\Http\Controllers\HomeController::class, 'partnerDetail'])->name('partner.detail');
// Halaman Detail Promo (Banner Statis 1, 2, 3)
Route::get('/promo-banner/{id}', [HomeController::class, 'promoDetail'])->name('promo.detail');
Route::middleware(['auth'])->group(function () {
    
    // Ini otomatis membuat semua route: index, create, store, edit, update, destroy
    Route::resource('users', UserController::class);

});
// Halaman Detail Promo Dinamis (Dari Database via Slug)
Route::get('/promo/{slug}', function($slug) {
    $promo = Promo::where('slug', $slug)->firstOrFail();
    return view('pages.promo-detail-dynamic', compact('promo'));
})->name('promo.detail.slug');

Route::get('/inspiration/{slug}', function($slug) {
    $inspiration = \App\Models\Inspiration::with('hotels')->where('slug', $slug)->firstOrFail();
    return view('pages.inspiration-detail', compact('inspiration'));
})->name('inspiration.detail');