@extends('layouts.dashboard')

@section('title', 'Data Bansos')

@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-6">Data Bantuan Sosial (Bansos)</h2>

{{-- Tombol tambah data --}}
<div class="mb-6">
    <button id="showFormBtn" class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
        <i class="fas fa-plus mr-2"></i> Tambah Data Bansos
    </button>
</div>

{{-- Form tambah bansos (hidden by default) --}}
<div id="formTambahBansos" class="mb-8 hidden">
    <div class="bg-white rounded-lg shadow p-6 mb-4">
        <h3 class="font-bold text-lg mb-4 text-[#2C7961]">Tambah Data Bansos</h3>
        <form id="bansosForm" onsubmit="return tambahBansos(event)">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jenis Bansos</label>
                <select id="jenisBansos" class="w-full px-4 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Jenis Bansos</option>
                    <option value="PKH">PKH</option>
                    <option value="BPNT">BPNT</option>
                    <option value="PIP">PIP</option>
                    <option value="JKN-KIS">JKN-KIS</option>
                    <option value="BLT">BLT</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                <input type="number" id="jumlahBansos" class="w-full px-4 py-2 border rounded" required min="1" value="1">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Satuan</label>
                <select id="satuanBansos" class="w-full px-4 py-2 border rounded" required>
                    <option value="Keluarga">Keluarga</option>
                    <option value="Anak">Anak</option>
                    <option value="Jiwa">Jiwa</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-[#2C7961] text-white px-4 py-2 rounded hover:bg-[#256952]">Simpan</button>
                <button type="button" onclick="tutupForm()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
            </div>
        </form>
    </div>
</div>

{{-- Tabel data bansos --}}
<div class="overflow-x-auto">
    <table id="bansosTable" class="min-w-full bg-white rounded-lg shadow">
        <thead>
            <tr class="bg-[#2C7961] text-white">
                <th class="py-3 px-4 text-left">Jenis Bansos</th>
                <th class="py-3 px-4 text-center">Jumlah</th>
                <th class="py-3 px-4 text-center">Satuan</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Data statis awal --}}
            <tr>
                <td class="py-3 px-4">PKH</td>
                <td class="py-3 px-4 text-center">
                    <span class="jumlah">320</span>
                </td>
                <td class="py-3 px-4 text-center">Keluarga</td>
                <td class="py-3 px-4 text-center">
                    <button onclick="editBansos(this)" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
                    <button onclick="hapusBansos(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td class="py-3 px-4">BPNT</td>
                <td class="py-3 px-4 text-center">
                    <span class="jumlah">410</span>
                </td>
                <td class="py-3 px-4 text-center">Keluarga</td>
                <td class="py-3 px-4 text-center">
                    <button onclick="editBansos(this)" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
                    <button onclick="hapusBansos(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td class="py-3 px-4">PIP</td>
                <td class="py-3 px-4 text-center">
                    <span class="jumlah">150</span>
                </td>
                <td class="py-3 px-4 text-center">Anak</td>
                <td class="py-3 px-4 text-center">
                    <button onclick="editBansos(this)" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
                    <button onclick="hapusBansos(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td class="py-3 px-4">JKN-KIS</td>
                <td class="py-3 px-4 text-center">
                    <span class="jumlah">1200</span>
                </td>
                <td class="py-3 px-4 text-center">Jiwa</td>
                <td class="py-3 px-4 text-center">
                    <button onclick="editBansos(this)" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
                    <button onclick="hapusBansos(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td class="py-3 px-4">BLT</td>
                <td class="py-3 px-4 text-center">
                    <span class="jumlah">90</span>
                </td>
                <td class="py-3 px-4 text-center">Keluarga</td>
                <td class="py-3 px-4 text-center">
                    <button onclick="editBansos(this)" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
                    <button onclick="hapusBansos(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="mt-8">
    <h3 class="text-xl font-bold text-[#2C7961] mb-4">Keterangan</h3>
    <p class="text-gray-700">Data bansos di atas dapat diupdate sesuai realisasi penyaluran bantuan di desa.</p>
</div>

<script>
    // Tampilkan form tambah bansos
    document.getElementById('showFormBtn').onclick = function() {
        document.getElementById('formTambahBansos').classList.remove('hidden');
        window.scrollTo({ top: document.getElementById('formTambahBansos').offsetTop - 80, behavior: 'smooth' });
    };

    // Tutup form tambah bansos
    function tutupForm() {
        document.getElementById('formTambahBansos').classList.add('hidden');
        document.getElementById('bansosForm').reset();
    }

    // Tambah data bansos (frontend)
    function tambahBansos(event) {
        event.preventDefault();
        const jenis = document.getElementById('jenisBansos').value;
        const jumlah = document.getElementById('jumlahBansos').value;
        const satuan = document.getElementById('satuanBansos').value;

        const tbody = document.getElementById('bansosTable').querySelector('tbody');
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="py-3 px-4">${jenis}</td>
            <td class="py-3 px-4 text-center">
                <span class="jumlah">${jumlah}</span>
            </td>
            <td class="py-3 px-4 text-center">${satuan}</td>
            <td class="py-3 px-4 text-center">
                <button onclick="editBansos(this)" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
                <button onclick="hapusBansos(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
            </td>
        `;
        tbody.appendChild(tr);
        tutupForm();
        return false;
    }

    // Hapus data bansos
    function hapusBansos(btn) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            btn.closest('tr').remove();
        }
    }

    // Edit data bansos (jenis, satuan, dan jumlah dengan tombol + / -)
    function editBansos(btn) {
        const tr = btn.closest('tr');
        const tds = tr.querySelectorAll('td');
        const jenis = tds[0].innerText;
        const jumlah = tds[1].querySelector('.jumlah').innerText;
        const satuan = tds[2].innerText;

        // Ganti jenis dengan dropdown
        tds[0].innerHTML = `
            <select class="w-full px-2 py-1 border rounded" id="editJenis">
                <option value="PKH" ${jenis === 'PKH' ? 'selected' : ''}>PKH</option>
                <option value="BPNT" ${jenis === 'BPNT' ? 'selected' : ''}>BPNT</option>
                <option value="PIP" ${jenis === 'PIP' ? 'selected' : ''}>PIP</option>
                <option value="JKN-KIS" ${jenis === 'JKN-KIS' ? 'selected' : ''}>JKN-KIS</option>
                <option value="BLT" ${jenis === 'BLT' ? 'selected' : ''}>BLT</option>
            </select>
        `;

        // Ganti jumlah dengan input dan tombol + / -
        tds[1].innerHTML = `
            <button onclick="ubahJumlah(this, -1)" class="bg-gray-200 px-2 rounded hover:bg-gray-300">-</button>
            <input type="number" id="editJumlah" class="w-16 text-center border rounded px-1 py-0.5" min="1" value="${jumlah}">
            <button onclick="ubahJumlah(this, 1)" class="bg-gray-200 px-2 rounded hover:bg-gray-300">+</button>
        `;

        // Ganti satuan dengan dropdown
        tds[2].innerHTML = `
            <select class="w-full px-2 py-1 border rounded" id="editSatuan">
                <option value="Keluarga" ${satuan === 'Keluarga' ? 'selected' : ''}>Keluarga</option>
                <option value="Anak" ${satuan === 'Anak' ? 'selected' : ''}>Anak</option>
                <option value="Jiwa" ${satuan === 'Jiwa' ? 'selected' : ''}>Jiwa</option>
            </select>
        `;

        // Ganti tombol aksi menjadi simpan dan batal
        tds[3].innerHTML = `
            <button onclick="simpanEditBansos(this)" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs font-semibold mr-1"><i class="fas fa-save"></i></button>
            <button onclick="batalEditBansos(this, '${jenis}', '${jumlah}', '${satuan}')" class="bg-gray-400 hover:bg-gray-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-times"></i></button>
        `;
    }

    // Simpan edit bansos
    function simpanEditBansos(btn) {
        const tr = btn.closest('tr');
        const tds = tr.querySelectorAll('td');
        const jenis = tds[0].querySelector('select').value;
        const jumlah = tds[1].querySelector('input').value;
        const satuan = tds[2].querySelector('select').value;

        tds[0].innerText = jenis;
        tds[1].innerHTML = `<span class="jumlah">${jumlah}</span>`;
        tds[2].innerText = satuan;
        tds[3].innerHTML = `
            <button onclick="editBansos(this)" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
            <button onclick="hapusBansos(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
        `;
    }

    // Batal edit bansos
    function batalEditBansos(btn, jenisLama, jumlahLama, satuanLama) {
        const tr = btn.closest('tr');
        const tds = tr.querySelectorAll('td');

        tds[0].innerText = jenisLama;
        tds[1].innerHTML = `<span class="jumlah">${jumlahLama}</span>`;
        tds[2].innerText = satuanLama;
        tds[3].innerHTML = `
            <button onclick="editBansos(this)" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-edit"></i></button>
            <button onclick="hapusBansos(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
        `;
    }

    // Tambah/kurang jumlah bansos saat edit
    function ubahJumlah(btn, delta) {
        const input = btn.parentElement.querySelector('input[type="number"]');
        let val = parseInt(input.value);
        val += delta;
        if (val < 1) val = 1;
        input.value = val;
    }
</script>
@endsection
