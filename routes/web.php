<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PotensiDesaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GaleriFotoController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\DataStuntingController;
use App\Http\Controllers\Dashboard\Penduduk\PendidikanController;

Route::view('/', 'home')->name('home');

// Login & Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', fn() => view('dashboard.index'))->name('index');
    Route::get('/penduduk', fn() => view('dashboard.penduduk'))->name('penduduk');
    Route::resource('bansos', BansosController::class)
    ->names([
        'index'   => 'bansos.index',
        'create'  => 'bansos.create',
        'store'   => 'bansos.store',
        'show'    => 'bansos.show',
        'edit'    => 'bansos.edit',
        'update'  => 'bansos.update',
        'destroy' => 'bansos.destroy',
    ])
    ->parameters([
        'bansos' => 'bansos',
    ]);
    Route::resource('stunting', DataStuntingController::class)
        ->names([
            'index'   => 'stunting.index',
            'create'  => 'stunting.create',
            'store'   => 'stunting.store',
            'show'    => 'stunting.show',
            'edit'    => 'stunting.edit',
            'update'  => 'stunting.update',
            'destroy' => 'stunting.destroy',
        ])
        ->parameters([
            'stunting' => 'dataStunting'
        ]);
    Route::prefix('penduduk')->group(function () {
        // Ringkasan Kependudukan
        Route::get('/', fn() => view('dashboard.penduduk'))->name('penduduk');

        // Data Pendidikan
        Route::get('/pendidikan', fn() => view('dashboard.penduduk.pendidikan'))
            ->name('penduduk.pendidikan');

        // Data Pekerjaan
        Route::get('/pekerjaan', fn() => view('dashboard.penduduk.pekerjaan'))
            ->name('penduduk.pekerjaan');

        // Data Kelompok Umur
        Route::get('/umur', fn() => view('dashboard.penduduk.umur'))
            ->name('penduduk.umur');

        // Data Agama
        Route::get('/agama', fn() => view('dashboard.penduduk.agama'))
            ->name('penduduk.agama');

        // Data Perkawinan
        Route::get('/perkawinan', fn() => view('dashboard.penduduk.perkawinan'))
            ->name('penduduk.perkawinan');

        // Data Per Dusun
        Route::get('/dusun', fn() => view('dashboard.penduduk.dusun'))
            ->name('penduduk.dusun');
    });
    Route::get('bansos/{bansos}/detail', [BansosController::class, 'detail'])
            ->name('bansos.detail');

    // Resource routes
    Route::resource('berita', BeritaController::class)->except(['show']);
    Route::resource('potensi', PotensiDesaController::class)->except(['show']);
    
    Route::resource('galeri-foto', GaleriFotoController::class)->names('galeri-foto');
    Route::get('galeri-foto/{galeri_foto}/detail', [GaleriFotoController::class, 'detail'])->name('galeri-foto.detail');
    Route::get('stunting/{dataStunting}/detail', [DataStuntingController::class, 'detail'])
        ->name('stunting.detail');
    Route::get('/kepaladusun', fn() => view('dashboard.kadus'))->name('kepaladusun');
    Route::resource('feedback', FeedbackController::class)->names('feedback');
    Route::get('feedback/{feedback}/detail', [FeedbackController::class, 'detail'])->name('feedback.detail');

});
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
    ->name('feedback.store.public');
Route::get('/galeri', [GaleriFotoController::class, 'publicIndex'])->name('galeri.index');
Route::get('/galeri/{galeri_foto}', [GaleriFotoController::class, 'publicShow'])->name('galeri.show');
