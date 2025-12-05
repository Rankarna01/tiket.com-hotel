<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Promo;
use App\Http\Controllers\Admin\SectionController;

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
// Register Routes
Route::get('/register', [App\Http\Controllers\Auth\LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\LoginController::class, 'register'])->name('register.post');

// ====================================================
// 2. ADMIN ROUTES (Protected by Auth Middleware)
// ====================================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard (Sekaligus List Hotel & CRUD Modal Hotel)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('sections', SectionController::class);
    
    // Proses Tambah & Hapus Hotel
    Route::post('/hotels', [DashboardController::class, 'store'])->name('hotels.store');
    Route::delete('/hotels/{hotel}', [DashboardController::class, 'destroy'])->name('hotels.destroy');

    // Manajemen Promo (Resource Controller)
    Route::resource('promos', PromoController::class);
});


// ====================================================
// 3. PUBLIC ROUTES (User Frontend)
// ====================================================

// Halaman Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Detail Hotel (Slug dinamis)
Route::get('/hotel/{slug}', [HomeController::class, 'hotelDetail'])->name('hotel.detail');

// Halaman Detail Promo (Banner Statis 1, 2, 3)
Route::get('/promo-banner/{id}', [HomeController::class, 'promoDetail'])->name('promo.detail');

// Halaman Detail Promo Dinamis (Dari Database via Slug)
Route::get('/promo/{slug}', function($slug) {
    $promo = Promo::where('slug', $slug)->firstOrFail();
    return view('pages.promo-detail-dynamic', compact('promo'));
})->name('promo.detail.slug');