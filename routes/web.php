<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;

// Rute Home
Route::view('/', 'home')->name('home');

// Rute Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

// Rute Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Dashboard (hanya untuk yang sudah login)
Route::prefix('dashboard')->group(function () {
    Route::get('/', fn() => view('dashboard.index'))->name('dashboard.index');
    Route::get('/penduduk', fn() => view('dashboard.penduduk'))->name('dashboard.penduduk');
    Route::get('/bansos', fn() => view('dashboard.bansos'))->name('dashboard.bansos');
    Route::get('/berita', fn() => view('dashboard.berita'))->name('dashboard.berita');
    Route::get('/galeri', fn() => view('dashboard.galeri'))->name('dashboard.galeri');
    Route::get('/potensi', fn() => view('dashboard.potensi'))->name('dashboard.potensi');
    Route::get('/stunting', fn() => view('dashboard.stunting'))->name('dashboard.stunting');
    Route::get('/kepaladusun', fn() => view('dashboard.kadus'))->name('dashboard.kepaladusun');
});
