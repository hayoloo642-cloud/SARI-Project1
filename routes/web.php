<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
Route::middleware(['auth', 'role:admin,kontributor'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.placeholder', [
            'totalDestinasi' => Destinasi::count(),
            'totalUlasanPending' => Ulasan::where('status', 'pending')->count(),
            'totalKontributor' => User::where('role', 'kontributor')->count(),
            'ulasanTerbaru' => Ulasan::with('destinasi')->latest()->take(6)->get(),
        ]);
    })->name('admin.home');
});
