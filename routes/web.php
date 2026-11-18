<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\AktivitasController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('wilayah', WilayahController::class);
Route::apiResource('aktivitas', AktivitasController::class)->parameter('aktivitas', 'aktivitas');
