@extends('layouts.dashboard')

@section('title', 'Potensi Desa')

@section('content')

<h2 class="text-3xl font-bold text-gray-800 mb-6">Potensi Desa Bandar Rejo</h2>

{{-- Tombol tambah potensi --}}
<div class="mb-6">
    <button id="btnTambahPotensi" class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
        <i class="fas fa-plus mr-2"></i> Tambah Potensi Baru
    </button>
</div>

{{-- Form tambah/edit potensi (hidden by default) --}}
<div id="formPotensi" class="hidden max-w-md bg-white rounded-lg shadow p-6 mb-8">
    <h3 id="formTitle" class="text-xl font-bold text-[#2C7961] mb-4">Tambah Potensi Baru</h3>
    <form id="potensiForm" onsubmit="return simpanPotensi(event)">
        <input type="hidden" id="editIndex" value="">
        <div class="mb-4">
            <label for="judulPotensi" class="block text-gray-700 font-semibold mb-2">Judul Potensi</label>
            <input type="text" id="judulPotensi" class="w-full px-4 py-2 border rounded" placeholder="Masukkan judul potensi" required>
        </div>
        <div class="mb-4">
            <label for="deskripsiPotensi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
            <textarea id="deskripsiPotensi" rows="4" class="w-full px-4 py-2 border rounded" placeholder="Masukkan deskripsi potensi" required></textarea>
        </div>
        <div class="mb-4">
            <label for="gambarPotensi" class="block text-gray-700 font-semibold mb-2">Gambar</label>
            <input type="file" id="gambarPotensi" accept="image/*" class="w-full px-4 py-2 border rounded bg-white" required>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-[#2C7961] text-white px-4 py-2 rounded hover:bg-[#256952]">Simpan</button>
            <button type="button" onclick="batalEdit()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
        </div>
    </form>
</div>

{{-- Grid potensi desa --}}
<div id="potensiGrid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Data awal statis --}}
    <div class="bg-white rounded-lg shadow p-6">
        <img src="{{ asset('images/pertanian.jpg') }}" alt="Pertanian" class="w-full h-40 object-cover rounded mb-4">
        <h3 class="font-bold text-xl text-[#2C7961] mb-2">Pertanian</h3>
        <p class="text-gray-700">Desa Bandar Rejo memiliki lahan pertanian padi seluas 150 ha dengan hasil panen rata-rata 7 ton/ha.</p>
        <button onclick="editPotensi(0)" class="mt-4 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded font-semibold">Edit</button>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <img src="{{ asset('images/peternakan.jpg') }}" alt="Peternakan" class="w-full h-40 object-cover rounded mb-4">
        <h3 class="font-bold text-xl text-[#2C7961] mb-2">Peternakan</h3>
        <p class="text-gray-700">Terdapat kelompok ternak sapi dan kambing yang aktif di Dusun 2 dan 3.</p>
        <button onclick="editPotensi(1)" class="mt-4 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded font-semibold">Edit</button>
    </div>
</div>

<script>
    const potensiGrid = document.getElementById('potensiGrid');
    const formPotensi = document.getElementById('formPotensi');
    const formTitle = document.getElementById('formTitle');
    const potensiForm = document.getElementById('potensiForm');
    const btnTambahPotensi = document.getElementById('btnTambahPotensi');
    const inputJudulPotensi = document.getElementById('judulPotensi');
    const inputDeskripsiPotensi = document.getElementById('deskripsiPotensi');
    const inputGambarPotensi = document.getElementById('gambarPotensi');
    const inputEditIndex = document.getElementById('editIndex');

    // Data awal (sinkron dengan kartu statis)
    let dataPotensi = [
        { judul: 'Pertanian', deskripsi: 'Desa Bandar Rejo memiliki lahan pertanian padi seluas 150 ha dengan hasil panen rata-rata 7 ton/ha.', gambar: '{{ asset("images/pertanian.jpg") }}' },
        { judul: 'Peternakan', deskripsi: 'Terdapat kelompok ternak sapi dan kambing yang aktif di Dusun 2 dan 3.', gambar: '{{ asset("images/peternakan.jpg") }}' },
    ];

    // Tampilkan form tambah potensi
    btnTambahPotensi.addEventListener('click', () => {
        formTitle.textContent = 'Tambah Potensi Baru';
        inputJudulPotensi.value = '';
        inputDeskripsiPotensi.value = '';
        inputGambarPotensi.value = '';
        inputEditIndex.value = '';
        formPotensi.classList.remove('hidden');
        window.scrollTo({ top: formPotensi.offsetTop - 80, behavior: 'smooth' });
    });

    // Fungsi batal edit/tambah
    function batalEdit() {
        formPotensi.classList.add('hidden');
        potensiForm.reset();
        inputEditIndex.value = '';
    }

    // Fungsi simpan potensi (tambah atau edit)
    function simpanPotensi(e) {
        e.preventDefault();
        const judul = inputJudulPotensi.value.trim();
        const deskripsi = inputDeskripsiPotensi.value.trim();
        const gambarFile = inputGambarPotensi.files[0];

        if (!judul || !deskripsi || !gambarFile) {
            alert('Mohon isi semua data dengan benar.');
            return false;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const gambar = e.target.result;
            const editIndex = inputEditIndex.value;

            if (editIndex === '') {
                // Tambah data baru
                dataPotensi.push({ judul, deskripsi, gambar });
            } else {
                // Edit data existing
                dataPotensi[editIndex] = { judul, deskripsi, gambar };
            }

            renderPotensi();
            batalEdit();
        };
        reader.readAsDataURL(gambarFile);

        return false;
    }

    // Render ulang grid potensi
    function renderPotensi() {
        potensiGrid.innerHTML = '';
        dataPotensi.forEach((item, index) => {
            const card = document.createElement('div');
            card.className = 'bg-white rounded-lg shadow p-6';
            card.innerHTML = `
                <img src="${item.gambar}" alt="${item.judul}" class="w-full h-40 object-cover rounded mb-4">
                <h3 class="font-bold text-xl text-[#2C7961] mb-2">${item.judul}</h3>
                <p class="text-gray-700">${item.deskripsi}</p>
                <button onclick="editPotensi(${index})" class="mt-4 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded font-semibold">Edit</button>
            `;
            potensiGrid.appendChild(card);
        });
    }

    // Fungsi edit potensi
    function editPotensi(index) {
        const item = dataPotensi[index];
        formTitle.textContent = 'Edit Potensi';
        inputJudulPotensi.value = item.judul;
        inputDeskripsiPotensi.value = item.deskripsi;
        inputEditIndex.value = index;
        formPotensi.classList.remove('hidden');
        window.scrollTo({ top: formPotensi.offsetTop - 80, behavior: 'smooth' });
    }
</script>
@endsection
