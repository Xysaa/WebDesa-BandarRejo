@extends('layouts.dashboard')

@section('title', 'Galeri Foto')

@section('content')

<h2 class="text-3xl font-bold text-gray-800 mb-6">Galeri Foto Desa</h2>

{{-- Tombol tambah foto --}}
<div class="mb-6">
    <button id="showFormBtn" class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
        <i class="fas fa-plus mr-2"></i> Tambah Foto Baru
    </button>
</div>

{{-- Form tambah foto (hidden by default) --}}
<div id="formTambahFoto" class="mb-8 hidden">
    <div class="bg-white rounded-lg shadow p-6 mb-4">
        <h3 class="font-bold text-lg mb-4 text-[#2C7961]">Tambah Foto Baru</h3>
        <form id="galeriForm" enctype="multipart/form-data" onsubmit="return tambahFoto(event)">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Judul Foto</label>
                <input type="text" id="judulFoto" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                <input type="date" id="tanggalFoto" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pilih Gambar</label>
                <input type="file" id="gambarFoto" accept="image/*" class="w-full px-4 py-2 border rounded bg-white" required>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-[#2C7961] text-white px-4 py-2 rounded hover:bg-[#256952]">Simpan</button>
                <button type="button" onclick="tutupForm()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
            </div>
        </form>
    </div>
</div>

{{-- Galeri Foto --}}
<div id="galeriGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    {{-- Foto statis awal --}}
    <div class="bg-white rounded-lg shadow p-2 group relative">
        <img src="{{ asset('images/galeri1.jpg') }}" alt="Galeri 1" class="rounded-lg w-full h-48 object-cover mb-2">
        <div class="font-semibold text-gray-800">Kegiatan Gotong Royong</div>
        <div class="text-gray-500 text-sm">12 Mei 2025</div>
        <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
            <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
            <button onclick="hapusFoto(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-2 group relative">
        <img src="{{ asset('images/galeri2.jpg') }}" alt="Galeri 2" class="rounded-lg w-full h-48 object-cover mb-2">
        <div class="font-semibold text-gray-800">Panen Raya Padi</div>
        <div class="text-gray-500 text-sm">28 April 2025</div>
        <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
            <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
            <button onclick="hapusFoto(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
        </div>
    </div>
    {{-- Foto baru akan ditambahkan di sini oleh JS --}}
</div>

{{-- Script untuk interaksi frontend --}}
<script>
    // Tampilkan form tambah foto
    document.getElementById('showFormBtn').onclick = function() {
        document.getElementById('formTambahFoto').classList.remove('hidden');
        window.scrollTo({ top: document.getElementById('formTambahFoto').offsetTop - 80, behavior: 'smooth' });
    };

    // Tutup form tambah foto
    function tutupForm() {
        document.getElementById('formTambahFoto').classList.add('hidden');
        document.getElementById('galeriForm').reset();
    }

    // Fungsi tambah foto (simulasi frontend)
    function tambahFoto(event) {
        event.preventDefault();
        const judul = document.getElementById('judulFoto').value;
        const tanggal = document.getElementById('tanggalFoto').value;
        const gambarInput = document.getElementById('gambarFoto');
        const file = gambarInput.files[0];

        if (!file) return false;

        const reader = new FileReader();
        reader.onload = function(e) {
            const galeriGrid = document.getElementById('galeriGrid');
            const div = document.createElement('div');
            div.className = "bg-white rounded-lg shadow p-2 group relative";
            div.innerHTML = `
                <img src="${e.target.result}" alt="${judul}" class="rounded-lg w-full h-48 object-cover mb-2">
                <div class="font-semibold text-gray-800">${judul}</div>
                <div class="text-gray-500 text-sm">${formatTanggal(tanggal)}</div>
                <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
                    <button onclick="hapusFoto(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
                </div>
            `;
            galeriGrid.prepend(div);
            tutupForm();
        };
        reader.readAsDataURL(file);
        return false;
    }

    // Fungsi hapus foto (simulasi frontend)
    function hapusFoto(btn) {
        if (confirm('Yakin ingin menghapus foto ini?')) {
            btn.closest('.bg-white').remove();
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
