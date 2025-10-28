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

Route::get('/berita', function () {
    return view('berita');
});

Route::get('/berita/{slug}', function ($slug) {
    // Find the article using the slug from the dummy data
    $berita = [
        [
            'slug' => 'Berita1',
            'image' => 'images/gambar1.png',
            'title' => 'Survei Desa Bandar Rejo',
            'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
            'isi'=>'Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien vitae pellentesque sem placerat in id cursus mi pretium tellus duis convallis tempus leo eu aenean sed diam urna tempor pulvinar vivamus fringilla lacus nec metus bibendum egestas iaculis massa nisl malesuada lacinia integer nunc posuere ut hendrerit semper vel class aptent taciti sociosqu ad litora torquent per conubia nostra inceptos himenaeos orci varius natoque penatibus et magnis dis parturient montes nascetur ridiculus mus donec rhoncus eros lobortis nulla molestie mattis scelerisque maximus eget fermentum odio phasellus non purus est efficitur laoreet mauris pharetra vestibulum fusce dictum risus blandit quis suspendisse aliquet nisi sodales consequat magna ante condimentum neque at luctus nibh finibus facilisis dapibus etiam interdum tortor ligula congue sollicitudin erat viverra ac tincidunt nam porta elementum a enim euismod quam justo lectus commodo augue arcu dignissim velit aliquam imperdiet mollis nullam volutpat porttitor ullamcorper rutrum gravida.',
            'author' => 'Sigit Kurnia',
            'views' => 402,
            'date' => '2025-06-23',
        ],
        [
            'slug' => 'Berita2',
            'image' => 'images/gambar2.png',
            'title' => 'Survei Desa Bandar Rejo 2',
            'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
            'isi'=>'Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien vitae pellentesque sem placerat in id cursus mi pretium tellus duis convallis tempus leo eu aenean sed diam urna tempor pulvinar vivamus fringilla lacus nec metus bibendum egestas iaculis massa nisl malesuada lacinia integer nunc posuere ut hendrerit semper vel class aptent taciti sociosqu ad litora torquent per conubia nostra inceptos himenaeos orci varius natoque penatibus et magnis dis parturient montes nascetur ridiculus mus donec rhoncus eros lobortis nulla molestie mattis scelerisque maximus eget fermentum odio phasellus non purus est efficitur laoreet mauris pharetra vestibulum fusce dictum risus blandit quis suspendisse aliquet nisi sodales consequat magna ante condimentum neque at luctus nibh finibus facilisis dapibus etiam interdum tortor ligula congue sollicitudin erat viverra ac tincidunt nam porta elementum a enim euismod quam justo lectus commodo augue arcu dignissim velit aliquam imperdiet mollis nullam volutpat porttitor ullamcorper rutrum gravida.',
            'author' => 'Sigit Kurnia',
            'views' => 500,
            'date' => '2025-06-24',
        ],
        [
        'slug' => 'Berita3',
        'image' => 'images/gambar3.png',
        'title' => 'Survei Desa Bandar Rejo 3',
        'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
        'isi'=>'Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien vitae pellentesque sem placerat in id cursus mi pretium tellus duis convallis tempus leo eu aenean sed diam urna tempor pulvinar vivamus fringilla lacus nec metus bibendum egestas iaculis massa nisl malesuada lacinia integer nunc posuere ut hendrerit semper vel class aptent taciti sociosqu ad litora torquent per conubia nostra inceptos himenaeos orci varius natoque penatibus et magnis dis parturient montes nascetur ridiculus mus donec rhoncus eros lobortis nulla molestie mattis scelerisque maximus eget fermentum odio phasellus non purus est efficitur laoreet mauris pharetra vestibulum fusce dictum risus blandit quis suspendisse aliquet nisi sodales consequat magna ante condimentum neque at luctus nibh finibus facilisis dapibus etiam interdum tortor ligula congue sollicitudin erat viverra ac tincidunt nam porta elementum a enim euismod quam justo lectus commodo augue arcu dignissim velit aliquam imperdiet mollis nullam volutpat porttitor ullamcorper rutrum gravida.',
        'author' => 'Sigit Kurnia',
        'views' => 305,
        'date' => '2025-06-25',
      ],
      [
        'slug' => 'Berita4',
        'image' => 'images/gambar4.png',
        'title' => 'Survei Desa Bandar Rejo 4',
        'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
        'isi'=>'Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien vitae pellentesque sem placerat in id cursus mi pretium tellus duis convallis tempus leo eu aenean sed diam urna tempor pulvinar vivamus fringilla lacus nec metus bibendum egestas iaculis massa nisl malesuada lacinia integer nunc posuere ut hendrerit semper vel class aptent taciti sociosqu ad litora torquent per conubia nostra inceptos himenaeos orci varius natoque penatibus et magnis dis parturient montes nascetur ridiculus mus donec rhoncus eros lobortis nulla molestie mattis scelerisque maximus eget fermentum odio phasellus non purus est efficitur laoreet mauris pharetra vestibulum fusce dictum risus blandit quis suspendisse aliquet nisi sodales consequat magna ante condimentum neque at luctus nibh finibus facilisis dapibus etiam interdum tortor ligula congue sollicitudin erat viverra ac tincidunt nam porta elementum a enim euismod quam justo lectus commodo augue arcu dignissim velit aliquam imperdiet mollis nullam volutpat porttitor ullamcorper rutrum gravida.',
        'author' => 'Sigit Kurnia',
        'views' => 700,
        'date' => '2025-06-26',
      ],
      [
        'slug' => 'Berita5',
        'image' => 'images/gambar5.png',
        'title' => 'Survei Desa Bandar Rejo 5',
        'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
        'isi'=>'Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien vitae pellentesque sem placerat in id cursus mi pretium tellus duis convallis tempus leo eu aenean sed diam urna tempor pulvinar vivamus fringilla lacus nec metus bibendum egestas iaculis massa nisl malesuada lacinia integer nunc posuere ut hendrerit semper vel class aptent taciti sociosqu ad litora torquent per conubia nostra inceptos himenaeos orci varius natoque penatibus et magnis dis parturient montes nascetur ridiculus mus donec rhoncus eros lobortis nulla molestie mattis scelerisque maximus eget fermentum odio phasellus non purus est efficitur laoreet mauris pharetra vestibulum fusce dictum risus blandit quis suspendisse aliquet nisi sodales consequat magna ante condimentum neque at luctus nibh finibus facilisis dapibus etiam interdum tortor ligula congue sollicitudin erat viverra ac tincidunt nam porta elementum a enim euismod quam justo lectus commodo augue arcu dignissim velit aliquam imperdiet mollis nullam volutpat porttitor ullamcorper rutrum gravida.',
        'author' => 'Sigit Kurnia',
        'views' => 450,
        'date' => '2025-06-27',
      ],
      [
        'slug' => 'Berita6',
        'image' => 'images/gambar6.png',
        'title' => 'Survei Desa Bandar Rejo 6',
        'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
        'isi'=>'Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien vitae pellentesque sem placerat in id cursus mi pretium tellus duis convallis tempus leo eu aenean sed diam urna tempor pulvinar vivamus fringilla lacus nec metus bibendum egestas iaculis massa nisl malesuada lacinia integer nunc posuere ut hendrerit semper vel class aptent taciti sociosqu ad litora torquent per conubia nostra inceptos himenaeos orci varius natoque penatibus et magnis dis parturient montes nascetur ridiculus mus donec rhoncus eros lobortis nulla molestie mattis scelerisque maximus eget fermentum odio phasellus non purus est efficitur laoreet mauris pharetra vestibulum fusce dictum risus blandit quis suspendisse aliquet nisi sodales consequat magna ante condimentum neque at luctus nibh finibus facilisis dapibus etiam interdum tortor ligula congue sollicitudin erat viverra ac tincidunt nam porta elementum a enim euismod quam justo lectus commodo augue arcu dignissim velit aliquam imperdiet mollis nullam volutpat porttitor ullamcorper rutrum gravida.',
        'author' => 'Sigit Kurnia',
        'views' => 600,
        'date' => '2025-06-28',
      ],
    ];


    // Find the article by slug
    $artikel = collect($berita)->firstWhere('slug', $slug);

    if (!$artikel) {
        abort(404, 'Artikel tidak ditemukan');
    }

    return view('detail', compact('artikel','berita'));
});

Route::get('/infografis', function () {
    return view('infografis');
});
Route::get('/profil-desa', function () {
    return view('profil');
});