<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PotensiDesaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GaleriFotoController;
use App\Http\Controllers\BansosController;


// ========================
// Rute Publik
// ========================
Route::view('/', 'home')->name('home');

// Login & Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Rute Dashboard (hanya untuk yang sudah login)
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', fn() => view('dashboard.index'))->name('index');
    Route::get('/penduduk', fn() => view('dashboard.penduduk'))->name('penduduk');
     Route::resource('bansos', BansosController::class)
    ->names([
        'index'   => 'dashboard.bansos.index',
        'create'  => 'dashboard.bansos.create',
        'store'   => 'dashboard.bansos.store',
        'show'    => 'dashboard.bansos.show',
        'edit'    => 'dashboard.bansos.edit',
        'update'  => 'dashboard.bansos.update',
        'destroy' => 'dashboard.bansos.destroy',
    ])
    // 👇 ini kunci-nya: paksa nama parameter jadi {bansos}
    ->parameters([
        'bansos' => 'bansos',
    ]);

        // Alias ekstra: /dashboard/bansos/{bansos}/detail
        Route::get('bansos/{bansos}/detail', [BansosController::class, 'detail'])
            ->name('dashboard.bansos.detail');

    // Resource routes
    Route::resource('berita', BeritaController::class)->except(['show']);
    Route::resource('potensi', PotensiDesaController::class)->except(['show']);
    
    Route::resource('galeri-foto', GaleriFotoController::class)->names('dashboard.galeri-foto');
    Route::get('galeri-foto/{galeri_foto}/detail', [GaleriFotoController::class, 'detail'])->name('dashboard.galeri-foto.detail');
    Route::get('/stunting', fn() => view('dashboard.stunting'))->name('stunting');
    Route::get('/kepaladusun', fn() => view('dashboard.kadus'))->name('kepaladusun');
    Route::resource('feedback', FeedbackController::class)->names('dashboard.feedback');
    Route::get('feedback/{feedback}/detail', [FeedbackController::class, 'detail'])->name('dashboard.feedback.detail');
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
Route::get('/potensi-desa', [PotensiDesaController::class, 'index'])->name('potensi-desa.public');
Route::get('/potensi-desa/{potensiDesa}', [PotensiDesaController::class, 'show'])->name('potensi-desa.show');
Route::post('/feedback', [FeedbackController::class, 'store'])
    ->middleware('throttle:feedback-store')
    ->name('feedback.store.public');
Route::get('/galeri', [GaleriFotoController::class, 'publicIndex'])->name('galeri.index');
Route::get('/galeri/{galeri_foto}', [GaleriFotoController::class, 'publicShow'])->name('galeri.show');
