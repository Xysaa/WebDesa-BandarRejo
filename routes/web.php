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
use App\Http\Controllers\Dashboard\Penduduk\PekerjaanController;
use App\Http\Controllers\Dashboard\Penduduk\PendudukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\Dashboard\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
Route::middleware('auth')
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {

        // ADMIN + KEPALA DUSUN
        Route::middleware('role:admin,kepala_dusun')->group(function () {
            Route::prefix('penduduk')->group(function () {
                    Route::get('/', [PendudukController::class, 'index'])
                        ->name('penduduk');
                    Route::post('/penduduk', [PendudukController::class, 'store'])
                        ->name('penduduk.store');
                    Route::put('/penduduk/{penduduk}', [PendudukController::class, 'update'])
                        ->name('penduduk.update');
                    Route::delete('/penduduk/{penduduk}', [PendudukController::class, 'destroy'])
                        ->name('penduduk.destroy');
                Route::get('/pekerjaan', [PekerjaanController::class, 'index'])
                    ->name('pekerjaan.index');
                Route::post('/pekerjaan', [PekerjaanController::class, 'store'])
                    ->name('pekerjaan.store');
                Route::put('/pekerjaan/{pekerjaan}', [PekerjaanController::class, 'update'])
                ->name('pekerjaan.update');
                Route::delete('/pekerjaan/{pekerjaan}', [PekerjaanController::class, 'destroy'])
                    ->name('pekerjaan.destroy');
            });

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

            Route::get('bansos/{bansos}/detail', [BansosController::class, 'detail'])
                ->name('bansos.detail');

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
        });

        // KHUSUS ADMIN
        Route::middleware('role:admin')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])
            ->name('index');
            Route::resource('berita', BeritaController::class)->except(['show']);
            Route::resource('potensi', PotensiDesaController::class)->except(['show']);

            Route::resource('galeri-foto', GaleriFotoController::class)
                ->names('galeri-foto');
            Route::get('galeri-foto/{galeri_foto}/detail', [GaleriFotoController::class, 'detail'])
                ->name('galeri-foto.detail');

            Route::get('/kepaladusun', fn() => view('dashboard.kadus'))
                ->name('kepaladusun');

            Route::resource('feedback', FeedbackController::class)->names('feedback');
            Route::get('feedback/{feedback}/detail', [FeedbackController::class, 'detail'])
                ->name('feedback.detail');
        });
    });

Route::get('/berita', [BeritaController::class, 'indexPublic'])->name('berita.public');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/infografis', [InfografisController::class, 'index'])->name('infografis');
Route::get('/profil-desa', function () {
    return view('profil');
});
Route::get('/potensi-desa', [PotensiDesaController::class, 'index'])->name('potensi-desa.public');
Route::get('/potensi-desa/{potensiDesa}', [PotensiDesaController::class, 'show'])->name('potensi-desa.show');
Route::post('/feedback', [FeedbackController::class, 'store'])
    ->name('feedback.store.public');
Route::get('/galeri', [GaleriFotoController::class, 'publicIndex'])->name('galeri.index');
Route::get('/galeri/{galeri_foto}', [GaleriFotoController::class, 'publicShow'])->name('galeri.show');
