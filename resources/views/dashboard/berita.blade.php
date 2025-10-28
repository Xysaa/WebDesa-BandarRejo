@extends('layouts.dashboard')

@section('title', 'Berita Desa')

@section('content')

<h2 class="text-3xl font-bold text-gray-800 mb-6">Berita & Kegiatan Desa</h2>

{{-- Tombol tambah berita --}}
<div class="mb-6">
    <button id="showFormBtn" class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
        <i class="fas fa-plus mr-2"></i> Tambah Berita Baru
    </button>
</div>

{{-- Form tambah berita (hidden by default) --}}
<div id="formTambahBerita" class="mb-8 hidden">
    <div class="bg-white rounded-lg shadow p-6 mb-4">
        <h3 class="font-bold text-lg mb-4 text-[#2C7961]">Tambah Berita Baru</h3>
        <form id="beritaForm" enctype="multipart/form-data" onsubmit="return tambahBerita(event)">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Judul Berita</label>
                <input type="text" id="judulBerita" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                <input type="date" id="tanggalBerita" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Konten Berita</label>
                <textarea id="kontenBerita" rows="4" class="w-full px-4 py-2 border rounded" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pilih Gambar</label>
                <input type="file" id="gambarBerita" accept="image/*" class="w-full px-4 py-2 border rounded bg-white" required>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-[#2C7961] text-white px-4 py-2 rounded hover:bg-[#256952]">Simpan</button>
                <button type="button" onclick="tutupForm()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
            </div>
        </form>
    </div>
</div>

{{-- Daftar berita --}}
<div id="beritaList" class="bg-white rounded-lg shadow p-6">
    <h3 class="font-bold text-xl text-[#2C7961] mb-4">Daftar Berita</h3>
    <ul class="divide-y divide-gray-200">
        {{-- Berita statis awal dengan gambar --}}
        <li class="py-4 group relative">
            <div class="flex items-start gap-4">
                <img src="{{ asset('images/berita1.jpg') }}" alt="Berita 1" class="w-24 h-24 object-cover rounded-lg">
                <div>
                    <div class="font-semibold text-lg">Pembangunan Jalan Dusun 1 Selesai</div>
                    <div class="text-gray-500 text-sm">Dipublikasikan: 10 Juni 2025</div>
                    <div class="text-gray-700 mt-2">Pembangunan jalan di Dusun 1 telah selesai dan dapat digunakan warga.</div>
                </div>
            </div>
            <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
                <button onclick="hapusBerita(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
            </div>
        </li>
        <li class="py-4 group relative">
            <div class="flex items-start gap-4">
                <img src="{{ asset('images/berita2.jpg') }}" alt="Berita 2" class="w-24 h-24 object-cover rounded-lg">
                <div>
                    <div class="font-semibold text-lg">Posyandu Balita Bulan Juni</div>
                    <div class="text-gray-500 text-sm">Dipublikasikan: 5 Juni 2025</div>
                    <div class="text-gray-700 mt-2">Kegiatan posyandu balita akan dilaksanakan pada tanggal 15 Juni 2025.</div>
                </div>
            </div>
            <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
                <button onclick="hapusBerita(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
            </div>
        </li>
        {{-- Berita baru akan ditambahkan di sini oleh JS --}}
    </ul>
</div>

{{-- Script untuk interaksi frontend --}}
<script>
    // Tampilkan form tambah berita
    document.getElementById('showFormBtn').onclick = function() {
        document.getElementById('formTambahBerita').classList.remove('hidden');
        window.scrollTo({ top: document.getElementById('formTambahBerita').offsetTop - 80, behavior: 'smooth' });
    };

    // Tutup form tambah berita
    function tutupForm() {
        document.getElementById('formTambahBerita').classList.add('hidden');
        document.getElementById('beritaForm').reset();
    }

    // Fungsi tambah berita (simulasi frontend)
    function tambahBerita(event) {
        event.preventDefault();
        const judul = document.getElementById('judulBerita').value;
        const tanggal = document.getElementById('tanggalBerita').value;
        const konten = document.getElementById('kontenBerita').value;
        const gambarInput = document.getElementById('gambarBerita');
        const file = gambarInput.files[0];

        if (!file) return false;

        const reader = new FileReader();
        reader.onload = function(e) {
            const beritaList = document.getElementById('beritaList').querySelector('ul');
            const li = document.createElement('li');
            li.className = "py-4 group relative";
            li.innerHTML = `
                <div class="flex items-start gap-4">
                    <img src="${e.target.result}" alt="${judul}" class="w-24 h-24 object-cover rounded-lg">
                    <div>
                        <div class="font-semibold text-lg">${judul}</div>
                        <div class="text-gray-500 text-sm">Dipublikasikan: ${formatTanggal(tanggal)}</div>
                        <div class="text-gray-700 mt-2">${konten}</div>
                    </div>
                </div>
                <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
                    <button onclick="hapusBerita(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
                </div>
            `;
            beritaList.prepend(li);
            tutupForm();
        };
        reader.readAsDataURL(file);
        return false;
    }

    // Fungsi hapus berita (simulasi frontend)
    function hapusBerita(btn) {
        if (confirm('Yakin ingin menghapus berita ini?')) {
            btn.closest('li').remove();
        }
    }

    // Format tanggal ke format Indonesia
    function formatTanggal(tgl) {
        if (!tgl) return '';
        const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        const d = new Date(tgl);
        return d.getDate() + ' ' + bulan[d.getMonth()] + ' ' + d.getFullYear();
    }
</script>

@endsection
