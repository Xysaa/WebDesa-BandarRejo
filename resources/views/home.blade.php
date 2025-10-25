@extends('welcome')

@section('title', 'Beranda Desa')

@section('content')
    <section class="w-full bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Selamat Datang di Desa Bandar Rejo
            </h1>
            <p class="text-gray-600 mb-6 leading-relaxed">
                Website Resmi Pemerintah Desa Bandar Rejo, Kecamatan Natar, Kabupaten Lampung Selatan.
                Dapatkan informasi terbaru seputar desa, layanan publik, dan kegiatan masyarakat.
            </p>
            <a href="{{ url('/berita') }}"
                class="inline-block bg-[#2C7961] hover:bg-[#256952] text-white font-medium px-6 py-3 rounded-md transition">
                Lihat Berita Terbaru
            </a>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-white shadow-sm rounded-lg">
                <h3 class="font-semibold text-lg mb-2 text-gray-800">Profil Desa</h3>
                <p class="text-sm text-gray-600">Mengenal sejarah, visi & misi, serta kondisi geografis Desa Bandar Rejo.</p>
            </div>

            <div class="p-6 bg-white shadow-sm rounded-lg">
                <h3 class="font-semibold text-lg mb-2 text-gray-800">Infografis</h3>
                <p class="text-sm text-gray-600">Informasi dalam bentuk visual terkait kependudukan, ekonomi, dan data desa.</p>
            </div>

            <div class="p-6 bg-white shadow-sm rounded-lg">
                <h3 class="font-semibold text-lg mb-2 text-gray-800">Berita & Kegiatan</h3>
                <p class="text-sm text-gray-600">Ikuti perkembangan berita dan aktivitas masyarakat desa terkini.</p>
            </div>
        </div>
    </section>
@endsection
