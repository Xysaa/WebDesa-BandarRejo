<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
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

// Halaman publik Berita
Route::get('/berita', function () {
    return view('berita');
});

Route::get('/berita/{slug}', function ($slug) {
    $berita = [
        // ... (isi array berita kamu, biarkan seperti semula)
    ];

    $artikel = collect($berita)->firstWhere('slug', $slug);
    if (!$artikel) {
        abort(404, 'Artikel tidak ditemukan');
    }

    return view('detail', compact('artikel','berita'));
});

Route::get('/infografis', fn() => view('infografis'));
Route::get('/profil-desa', fn() => view('profil'));

// ========================
// Endpoint publik untuk form feedback
// ========================
Route::post('/feedback', [FeedbackController::class, 'store'])
    ->middleware('throttle:feedback-store')
    ->name('feedback.store.public');

// ========================
// Halaman publik Galeri Foto
// ========================
Route::get('/galeri', [GaleriFotoController::class, 'publicIndex'])->name('galeri.index');
Route::get('/galeri/{galeri_foto}', [GaleriFotoController::class, 'publicShow'])->name('galeri.show');

// ========================
// Rute Dashboard
// ========================
Route::prefix('dashboard')
    // ->middleware('auth')
    ->group(function () {

        // Halaman statis dashboard yang sudah ada
        Route::get('/', fn() => view('dashboard.index'))->name('dashboard.index');
        Route::get('/penduduk', fn() => view('dashboard.penduduk'))->name('dashboard.penduduk');

        // ========================
        // Bansos (RESOURCE)
        // ========================
        // custom names supaya:
        //  - index  => 'dashboard.bansos'   (bukan 'dashboard.bansos.index')
        //  - lainnya => dashboard.bansos.create|store|show|edit|update|destroy

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

        Route::get('/berita', fn() => view('dashboard.berita'))->name('dashboard.berita');

        // ========================
        // Galeri Foto (RESOURCE)
        // ========================
        Route::resource('galeri-foto', GaleriFotoController::class)
            ->names('dashboard.galeri-foto');
        Route::get('galeri-foto/{galeri_foto}/detail', [GaleriFotoController::class, 'detail'])
            ->name('dashboard.galeri-foto.detail');

        Route::get('/potensi', fn() => view('dashboard.potensi'))->name('dashboard.potensi');
        Route::get('/stunting', fn() => view('dashboard.stunting'))->name('dashboard.stunting');
        Route::get('/kepaladusun', fn() => view('dashboard.kadus'))->name('dashboard.kepaladusun');

        // ========================
        // Feedback (RESOURCE)
        // ========================
        Route::resource('feedback', FeedbackController::class)
            ->names('dashboard.feedback');

        Route::get('feedback/{feedback}/detail', [FeedbackController::class, 'detail'])
            ->name('dashboard.feedback.detail');
    });
