<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\BudayaController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\DestinasiDetailController;
use App\Http\Controllers\DestinasiGambarController;
use App\Http\Controllers\DestinasiHighlightController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\StatistikKunjunganController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\BookmarkController;

Route::get('/', function () {
    return view('welcome');
});

// ---------- Auth ----------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ---------- Panel Admin (auth + role admin/kontributor) ----------
Route::middleware(['auth', 'role:admin,kontributor'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.placeholder');
    })->name('admin.home');
});

// ---------- API publik: READ-ONLY ----------
Route::apiResource('wilayah', WilayahController::class)->only(['index', 'show'])->parameter('wilayah', 'wilayah');
Route::apiResource('aktivitas', AktivitasController::class)->only(['index', 'show'])->parameter('aktivitas', 'aktivitas');
Route::apiResource('budaya', BudayaController::class)->only(['index', 'show'])->parameter('budaya', 'budaya');
Route::apiResource('kalender', KalenderController::class)->only(['index', 'show'])->parameter('kalender', 'kalender');
Route::apiResource('destinasi', DestinasiController::class)->only(['index', 'show'])->parameter('destinasi', 'destinasi');
Route::apiResource('destinasi-detail', DestinasiDetailController::class)->only(['index', 'show'])->parameter('destinasi-detail', 'destinasi_detail');
Route::apiResource('destinasi-gambar', DestinasiGambarController::class)->only(['index', 'show'])->parameter('destinasi-gambar', 'destinasi_gambar');
Route::apiResource('destinasi-highlight', DestinasiHighlightController::class)->only(['index', 'show'])->parameter('destinasi-highlight', 'destinasi_highlight');
Route::apiResource('ulasan', UlasanController::class)->only(['show'])->parameter('ulasan', 'ulasan');

// Tamu boleh kirim ulasan & hitung kunjungan (dibatasi throttle)
Route::post('ulasan', [UlasanController::class, 'store'])->middleware('throttle:5,1')->name('ulasan.store');
Route::post('statistik-kunjungan', [StatistikKunjunganController::class, 'store'])->middleware('throttle:30,1')->name('statistik-kunjungan.store');

// ---------- API: admin ATAU kontributor (tulis data destinasi) ----------
Route::middleware(['auth', 'role:admin,kontributor', 'throttle:10,1'])->group(function () {
    Route::post('destinasi', [DestinasiController::class, 'store'])->name('destinasi.store');
    Route::match(['put', 'patch'], 'destinasi/{destinasi}', [DestinasiController::class, 'update'])->name('destinasi.update');
    Route::post('destinasi-detail', [DestinasiDetailController::class, 'store'])->name('destinasi-detail.store');
    Route::match(['put', 'patch'], 'destinasi-detail/{destinasi_detail}', [DestinasiDetailController::class, 'update'])->name('destinasi-detail.update');
    Route::post('destinasi-gambar', [DestinasiGambarController::class, 'store'])->name('destinasi-gambar.store');
    Route::match(['put', 'patch'], 'destinasi-gambar/{destinasi_gambar}', [DestinasiGambarController::class, 'update'])->name('destinasi-gambar.update');
    Route::post('destinasi-highlight', [DestinasiHighlightController::class, 'store'])->name('destinasi-highlight.store');
    Route::match(['put', 'patch'], 'destinasi-highlight/{destinasi_highlight}', [DestinasiHighlightController::class, 'update'])->name('destinasi-highlight.update');

    // Bookmark: hanya untuk user yang login (scoped ke pemilik di controller)
    Route::apiResource('bookmark', BookmarkController::class)->parameter('bookmark', 'bookmark');
});

// ---------- API: hanya admin ----------
Route::middleware(['auth', 'role:admin', 'throttle:10,1'])->group(function () {
    Route::delete('destinasi/{destinasi}', [DestinasiController::class, 'destroy'])->name('destinasi.destroy');
    Route::delete('destinasi-detail/{destinasi_detail}', [DestinasiDetailController::class, 'destroy'])->name('destinasi-detail.destroy');
    Route::delete('destinasi-gambar/{destinasi_gambar}', [DestinasiGambarController::class, 'destroy'])->name('destinasi-gambar.destroy');
    Route::delete('destinasi-highlight/{destinasi_highlight}', [DestinasiHighlightController::class, 'destroy'])->name('destinasi-highlight.destroy');

    Route::apiResource('wilayah', WilayahController::class)->except(['index', 'show'])->parameter('wilayah', 'wilayah');
    Route::apiResource('aktivitas', AktivitasController::class)->except(['index', 'show'])->parameter('aktivitas', 'aktivitas');
    Route::apiResource('budaya', BudayaController::class)->except(['index', 'show'])->parameter('budaya', 'budaya');
    Route::apiResource('kalender', KalenderController::class)->except(['index', 'show'])->parameter('kalender', 'kalender');
    Route::apiResource('pengaturan', PengaturanController::class)->parameter('pengaturan', 'pengaturan');

    // Moderasi ulasan + statistik → admin
    Route::get('ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
    Route::match(['put', 'patch'], 'ulasan/{ulasan}', [UlasanController::class, 'update'])->name('ulasan.update');
    Route::delete('ulasan/{ulasan}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');
    Route::get('statistik-kunjungan', [StatistikKunjunganController::class, 'index'])->name('statistik-kunjungan.index');
    Route::get('statistik-kunjungan/{statistik_kunjungan}', [StatistikKunjunganController::class, 'show'])->name('statistik-kunjungan.show');
    Route::match(['put', 'patch'], 'statistik-kunjungan/{statistik_kunjungan}', [StatistikKunjunganController::class, 'update'])->name('statistik-kunjungan.update');
    Route::delete('statistik-kunjungan/{statistik_kunjungan}', [StatistikKunjunganController::class, 'destroy'])->name('statistik-kunjungan.destroy');
});
