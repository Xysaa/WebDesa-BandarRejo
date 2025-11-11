@extends('layouts.dashboard')

@section('title', 'Dasbor Utama')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang, Admin Desa Bandar Rejo!</h2>
    
    <!-- Konfirmasi Perubahan Data -->
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded shadow flex items-center justify-between mb-8">
        <div>
            <span class="font-semibold text-yellow-700">Konfirmasi:</span>
            <span class="text-yellow-700">Ada perubahan data dari Kepala Dusun. Mohon admin desa melakukan verifikasi sebelum data diubah.</span>
        </div>
        <button class="ml-4 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded font-semibold">Lihat & Konfirmasi</button>
    </div>

    <!-- Statistik Kependudukan -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-[#2C7961]">3.250</div>
            <div class="text-gray-600 mt-2">Total Penduduk</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-[#2C7961]">1.050</div>
            <div class="text-gray-600 mt-2">Kepala Keluarga</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-[#2C7961]">1.600</div>
            <div class="text-gray-600 mt-2">Laki-laki</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-[#2C7961]">1.650</div>
            <div class="text-gray-600 mt-2">Perempuan</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Umur</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Anak-anak (0-12): <span class="font-bold">500</span></li>
                <li>Remaja (13-17): <span class="font-bold">400</span></li>
                <li>Dewasa (18-59): <span class="font-bold">1.900</span></li>
                <li>Lansia (60+): <span class="font-bold">450</span></li>
            </ul>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Dusun</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Dusun 1: <span class="font-bold">1.200</span></li>
                <li>Dusun 2: <span class="font-bold">1.050</span></li>
                <li>Dusun 3: <span class="font-bold">1.000</span></li>
            </ul>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Pendidikan</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Tidak Sekolah: <span class="font-bold">120</span></li>
                <li>SD: <span class="font-bold">800</span></li>
                <li>SMP: <span class="font-bold">700</span></li>
                <li>SMA: <span class="font-bold">900</span></li>
                <li>Perguruan Tinggi: <span class="font-bold">730</span></li>
            </ul>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Pekerjaan</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Petani: <span class="font-bold">1.200</span></li>
                <li>Pegawai: <span class="font-bold">400</span></li>
                <li>Wiraswasta: <span class="font-bold">600</span></li>
                <li>Lainnya: <span class="font-bold">1.050</span></li>
            </ul>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Perkawinan</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Belum Kawin: <span class="font-bold">1.100</span></li>
                <li>Kawin: <span class="font-bold">1.900</span></li>
                <li>Cerai: <span class="font-bold">250</span></li>
            </ul>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Agama</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Islam: <span class="font-bold">2.900</span></li>
                <li>Kristen: <span class="font-bold">200</span></li>
                <li>Hindu: <span class="font-bold">100</span></li>
                <li>Buddha: <span class="font-bold">50</span></li>
            </ul>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Data Stunting per Dusun</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Dusun 1: <span class="font-bold">12</span> anak</li>
                <li>Dusun 2: <span class="font-bold">8</span> anak</li>
                <li>Dusun 3: <span class="font-bold">5</span> anak</li>
            </ul>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Data Bansos</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="bg-[#2C7961]/10 rounded p-4 text-center">
                <div class="font-bold text-xl text-[#2C7961]">PKH</div>
                <div class="text-gray-700">320 Keluarga</div>
            </div>
            <div class="bg-[#2C7961]/10 rounded p-4 text-center">
                <div class="font-bold text-xl text-[#2C7961]">BPNT</div>
                <div class="text-gray-700">410 Keluarga</div>
            </div>
            <div class="bg-[#2C7961]/10 rounded p-4 text-center">
                <div class="font-bold text-xl text-[#2C7961]">PIP</div>
                <div class="text-gray-700">150 Anak</div>
            </div>
            <div class="bg-[#2C7961]/10 rounded p-4 text-center">
                <div class="font-bold text-xl text-[#2C7961]">JKN-KIS</div>
                <div class="text-gray-700">1.200 Jiwa</div>
            </div>
            <div class="bg-[#2C7961]/10 rounded p-4 text-center">
                <div class="font-bold text-xl text-[#2C7961]">BLT</div>
                <div class="text-gray-700">90 Keluarga</div>
            </div>
        </div>
    </div>

</div>
@endsection
