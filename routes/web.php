<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDestinasiController;
use App\Http\Controllers\Admin\AdminBudayaController;
use App\Http\Controllers\Admin\AdminKalenderController;
use App\Http\Controllers\Admin\AdminUlasanController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinasiPageController;
use App\Http\Controllers\BudayaPageController;
use App\Http\Controllers\KalenderPageController;
use App\Models\Destinasi;
use App\Models\Ulasan;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Halaman publik & panel admin
|--------------------------------------------------------------------------
| API dipisah ke routes/api.php (prefix /api).
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Destinasi
Route::get('/destinasi', [DestinasiPageController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{destinasi:slug}', [DestinasiPageController::class, 'show'])->name('destinasi.show');
Route::get('/wilayah/{wilayah:slug}', [DestinasiPageController::class, 'wilayah'])->name('wilayah.show');

// Etika & budaya
Route::get('/etika', [BudayaPageController::class, 'index'])->name('etika.index');
Route::get('/etika/{budaya:slug}', [BudayaPageController::class, 'show'])->name('etika.show');

// Kalender hari suci
Route::get('/kalender', [KalenderPageController::class, 'index'])->name('kalender.index');

// Halaman statis
Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/privasi', 'privasi')->name('privasi');

// ---------- Auth ----------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.attempt');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1')
    ->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ---------- Akun pengunjung ----------
Route::get('/akun', [AccountController::class, 'index'])
    ->middleware('auth')
    ->name('akun');

// ---------- Panel admin (auth + role admin/kontributor) ----------
Route::middleware(['auth', 'role:admin,kontributor'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('home');

    // Destinasi CRUD
    Route::resource('destinasi', AdminDestinasiController::class)->except(['show']);

    // Etika Budaya CRUD
    Route::resource('budaya', AdminBudayaController::class)->except(['show']);

    // Kalender Agama CRUD
    Route::resource('kalender', AdminKalenderController::class)->except(['show']);

    // Moderasi Ulasan
    Route::get('ulasan', [AdminUlasanController::class, 'index'])->name('ulasan.index');
    Route::patch('ulasan/{ulasan}/status', [AdminUlasanController::class, 'updateStatus'])->name('ulasan.status');
    Route::delete('ulasan/{ulasan}', [AdminUlasanController::class, 'destroy'])->name('ulasan.destroy');
});
