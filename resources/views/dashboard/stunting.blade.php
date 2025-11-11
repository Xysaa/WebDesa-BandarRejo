@extends('layouts.dashboard')

@section('title', 'Data Stunting')

@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-6">Data Stunting per Dusun</h2>

{{-- Tombol tambah data --}}
<div class="mb-6">
    <button id="btnTambah" class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
        <i class="fas fa-plus mr-2"></i> Tambah Data Stunting
    </button>
</div>

{{-- Form tambah/edit data stunting (hidden by default) --}}
<div id="formContainer" class="hidden max-w-md bg-white rounded-lg shadow p-6 mb-8">
    <h3 id="formTitle" class="text-xl font-bold text-[#2C7961] mb-4">Tambah Data Stunting Baru</h3>
    <form id="formStunting" onsubmit="return simpanData(event)">
        <input type="hidden" id="editIndex" value="">
        <div class="mb-4">
            <label for="namaDusun" class="block text-gray-700 font-semibold mb-2">Nama Dusun</label>
            <input type="text" id="namaDusun" class="w-full px-4 py-2 border rounded" placeholder="Masukkan nama dusun" required>
        </div>
        <div class="mb-4">
            <label for="jumlahAnak" class="block text-gray-700 font-semibold mb-2">Jumlah Anak Stunting</label>
            <input type="number" id="jumlahAnak" class="w-full px-4 py-2 border rounded" min="0" value="0" required>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-[#2C7961] text-white px-4 py-2 rounded hover:bg-[#256952]">Simpan</button>
            <button type="button" onclick="batalEdit()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
        </div>
    </form>
</div>

{{-- Grid data stunting --}}
<div id="stuntingGrid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
    {{-- Data awal statis --}}
    <div class="bg-white rounded-lg shadow p-6 text-center" data-index="0">
        <div class="text-2xl font-bold text-[#2C7961] namaDusun">Dusun 1</div>
        <div class="text-4xl font-bold text-yellow-600 my-2 jumlahAnak">12</div>
        <div class="text-gray-600">Anak Stunting</div>
        <button onclick="editData(0)" class="mt-4 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded font-semibold">Edit</button>
    </div>
    <div class="bg-white rounded-lg shadow p-6 text-center" data-index="1">
        <div class="text-2xl font-bold text-[#2C7961] namaDusun">Dusun 2</div>
        <div class="text-4xl font-bold text-yellow-600 my-2 jumlahAnak">8</div>
        <div class="text-gray-600">Anak Stunting</div>
        <button onclick="editData(1)" class="mt-4 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded font-semibold">Edit</button>
    </div>
    <div class="bg-white rounded-lg shadow p-6 text-center" data-index="2">
        <div class="text-2xl font-bold text-[#2C7961] namaDusun">Dusun 3</div>
        <div class="text-4xl font-bold text-yellow-600 my-2 jumlahAnak">5</div>
        <div class="text-gray-600">Anak Stunting</div>
        <button onclick="editData(2)" class="mt-4 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded font-semibold">Edit</button>
    </div>
</div>

<div class="mt-8">
    <h3 class="text-xl font-bold text-[#2C7961] mb-4">Catatan & Tindak Lanjut</h3>
    <p class="text-gray-700">Data stunting di atas dapat digunakan untuk intervensi program kesehatan dan pemantauan perkembangan anak di setiap dusun.</p>
</div>

<script>
    const stuntingGrid = document.getElementById('stuntingGrid');
    const formContainer = document.getElementById('formContainer');
    const formTitle = document.getElementById('formTitle');
    const formStunting = document.getElementById('formStunting');
    const btnTambah = document.getElementById('btnTambah');
    const inputNamaDusun = document.getElementById('namaDusun');
    const inputJumlahAnak = document.getElementById('jumlahAnak');
    const inputEditIndex = document.getElementById('editIndex');

    // Data awal (sinkron dengan kartu statis)
    let dataStunting = [
        { namaDusun: 'Dusun 1', jumlahAnak: 12 },
        { namaDusun: 'Dusun 2', jumlahAnak: 8 },
        { namaDusun: 'Dusun 3', jumlahAnak: 5 },
    ];

    // Tampilkan form tambah data
    btnTambah.addEventListener('click', () => {
        formTitle.textContent = 'Tambah Data Stunting Baru';
        inputNamaDusun.value = '';
        inputJumlahAnak.value = 0;
        inputEditIndex.value = '';
        formContainer.classList.remove('hidden');
        window.scrollTo({ top: formContainer.offsetTop - 80, behavior: 'smooth' });
    });

    // Fungsi batal edit/tambah
    function batalEdit() {
        formContainer.classList.add('hidden');
        formStunting.reset();
        inputEditIndex.value = '';
    }

    // Fungsi simpan data (tambah atau edit)
    function simpanData(e) {
        e.preventDefault();
        const namaDusun = inputNamaDusun.value.trim();
        const jumlahAnak = parseInt(inputJumlahAnak.value);

        if (!namaDusun || isNaN(jumlahAnak) || jumlahAnak < 0) {
            alert('Mohon isi data dengan benar.');
            return false;
        }

        const editIndex = inputEditIndex.value;

        if (editIndex === '') {
            // Tambah data baru
            dataStunting.push({ namaDusun, jumlahAnak });
        } else {
            // Edit data existing
            dataStunting[editIndex] = { namaDusun, jumlahAnak };
        }

        renderGrid();
        batalEdit();
        return false;
    }

    // Render ulang grid kartu
    function renderGrid() {
        stuntingGrid.innerHTML = '';
        dataStunting.forEach((item, index) => {
            const card = document.createElement('div');
            card.className = 'bg-white rounded-lg shadow p-6 text-center';
            card.setAttribute('data-index', index);
            card.innerHTML = `
                <div class="text-2xl font-bold text-[#2C7961] namaDusun">${item.namaDusun}</div>
                <div class="text-4xl font-bold text-yellow-600 my-2 jumlahAnak">${item.jumlahAnak}</div>
                <div class="text-gray-600">Anak Stunting</div>
                <button onclick="editData(${index})" class="mt-4 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded font-semibold">Edit</button>
            `;
            stuntingGrid.appendChild(card);
        });
    }

    // Fungsi edit data
    function editData(index) {
        const item = dataStunting[index];
        formTitle.textContent = 'Edit Data Stunting';
        inputNamaDusun.value = item.namaDusun;
        inputJumlahAnak.value = item.jumlahAnak;
        inputEditIndex.value = index;
        formContainer.classList.remove('hidden');
        window.scrollTo({ top: formContainer.offsetTop - 80, behavior: 'smooth' });
    }
</script>
@endsection
