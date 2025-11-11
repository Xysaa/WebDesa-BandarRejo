<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PotensiDesaController;
use App\Http\Controllers\BeritaController;

// Rute Home
Route::view('/', 'home')->name('home');

// Rute Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

// Rute Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Dashboard (hanya untuk yang sudah login)
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', fn() => view('dashboard.index'))->name('index');
    Route::get('/penduduk', fn() => view('dashboard.penduduk'))->name('penduduk');
    Route::get('/bansos', fn() => view('dashboard.bansos'))->name('bansos');
    
    // Resource routes
    Route::resource('berita', BeritaController::class)->except(['show']);
    Route::resource('potensi', PotensiDesaController::class)->except(['show']);
    
    Route::get('/galeri', fn() => view('dashboard.galeri'))->name('galeri');
    Route::get('/stunting', fn() => view('dashboard.stunting'))->name('stunting');
    Route::get('/kepaladusun', fn() => view('dashboard.kadus'))->name('kepaladusun');
    Route::view('/feedback', 'dashboard.feedback')->name('feedback');
});

// Rute Public Berita
// Rute Public Berita (taruh sebelum route {slug} agar tidak konflik)
Route::get('/berita', [BeritaController::class, 'indexPublic'])->name('berita.public');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');


Route::get('/infografis', function () {
    return view('infografis');
});

Route::get('/profil-desa', function () {
    return view('profil');
});

// Route public untuk potensi desa
Route::get('/potensi-desa', [PotensiDesaController::class, 'index'])->name('potensi-desa.public');
Route::get('/potensi-desa/{potensiDesa}', [PotensiDesaController::class, 'show'])->name('potensi-desa.show');
