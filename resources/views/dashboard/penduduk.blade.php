@extends('layouts.dashboard')

@section('title', 'Data Kependudukan')

@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-6">Data Kependudukan Desa Bandar Rejo</h2>

{{-- Tombol tambah data --}}
<div class="mb-6">
    <button id="btnTambahPenduduk" class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
        <i class="fas fa-plus mr-2"></i> Tambah Data Penduduk
    </button>
</div>

{{-- Form tambah/edit penduduk (hidden by default) --}}
<div id="formPenduduk" class="hidden max-w-2xl bg-white rounded-lg shadow p-6 mb-8">
    <h3 id="formTitle" class="text-xl font-bold text-[#2C7961] mb-4">Tambah Data Penduduk</h3>
    <form id="pendudukForm" onsubmit="return simpanPenduduk(event)">
        <input type="hidden" id="editIndex" value="">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-1">NIK</label>
                <input type="text" id="nik" class="w-full px-3 py-2 border rounded" maxlength="16" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">No KK</label>
                <input type="text" id="nokk" class="w-full px-3 py-2 border rounded" maxlength="16" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                <input type="text" id="nama" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Jenis Kelamin</label>
                <select id="jk" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Tanggal Lahir</label>
                <input type="date" id="tglLahir" class="w-full px-3 py-2 border rounded" required onchange="hitungUmur()">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Umur</label>
                <input type="text" id="umur" class="w-full px-3 py-2 border rounded bg-gray-100" readonly>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Dusun</label>
                <select id="dusun" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Dusun</option>
                    <option value="Dusun 1">Dusun 1</option>
                    <option value="Dusun 2">Dusun 2</option>
                    <option value="Dusun 3">Dusun 3</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Pendidikan</label>
                <select id="pendidikan" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Pendidikan</option>
                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Pekerjaan</label>
                <select id="pekerjaan" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Pekerjaan</option>
                    <option value="Petani">Petani</option>
                    <option value="Pegawai">Pegawai</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Status Perkawinan</label>
                <select id="perkawinan" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Kawin">Kawin</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                    <option value="Kawin Tidak Tercatat">Kawin Tidak Tercatat</option>
                    <option value="Cerai Hidup">Cerai Hidup</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Agama</label>
                <select id="agama" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-semibold mb-1">Alamat</label>
                <input type="text" id="alamat" class="w-full px-3 py-2 border rounded" required>
            </div>
        </div>
        <div class="flex gap-2 mt-4">
            <button type="submit" class="bg-[#2C7961] text-white px-4 py-2 rounded hover:bg-[#256952]">Simpan</button>
            <button type="button" onclick="batalEdit()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
        </div>
    </form>
</div>

{{-- Tabel data penduduk --}}
<div class="overflow-x-auto">
    <table id="pendudukTable" class="min-w-full bg-white rounded-lg shadow text-sm">
        <thead>
            <tr class="bg-[#2C7961] text-white">
                <th class="py-2 px-3">NIK</th>
                <th class="py-2 px-3">No KK</th>
                <th class="py-2 px-3">Nama</th>
                <th class="py-2 px-3">JK</th>
                <th class="py-2 px-3">Tgl Lahir</th>
                <th class="py-2 px-3">Umur</th>
                <th class="py-2 px-3">Dusun</th>
                <th class="py-2 px-3">Pendidikan</th>
                <th class="py-2 px-3">Pekerjaan</th>
                <th class="py-2 px-3">Perkawinan</th>
                <th class="py-2 px-3">Agama</th>
                <th class="py-2 px-3">Alamat</th>
                <th class="py-2 px-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Data awal kosong, data akan muncul setelah tambah --}}
        </tbody>
    </table>
</div>

<script>
    const btnTambahPenduduk = document.getElementById('btnTambahPenduduk');
    const formPenduduk = document.getElementById('formPenduduk');
    const formTitle = document.getElementById('formTitle');
    const pendudukForm = document.getElementById('pendudukForm');
    const inputEditIndex = document.getElementById('editIndex');
    const tableBody = document.getElementById('pendudukTable').querySelector('tbody');

    // Data array frontend
    let dataPenduduk = [];

    // Tampilkan form tambah
    btnTambahPenduduk.onclick = function() {
        formTitle.textContent = 'Tambah Data Penduduk';
        pendudukForm.reset();
        inputEditIndex.value = '';
        formPenduduk.classList.remove('hidden');
        window.scrollTo({ top: formPenduduk.offsetTop - 80, behavior: 'smooth' });
    };

    // Batal tambah/edit
    function batalEdit() {
        formPenduduk.classList.add('hidden');
        pendudukForm.reset();
        inputEditIndex.value = '';
    }

    // Hitung umur otomatis
    function hitungUmur() {
        const tgl = document.getElementById('tglLahir').value;
        if (!tgl) {
            document.getElementById('umur').value = '';
            return;
        }
        const today = new Date();
        const birth = new Date(tgl);
        let umur = today.getFullYear() - birth.getFullYear();
        const m = today.getMonth() - birth.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) {
            umur--;
        }
        document.getElementById('umur').value = umur + ' tahun';
    }

    // Simpan data penduduk (tambah/edit)
    function simpanPenduduk(e) {
        e.preventDefault();
        const data = {
            nik: document.getElementById('nik').value.trim(),
            nokk: document.getElementById('nokk').value.trim(),
            nama: document.getElementById('nama').value.trim(),
            jk: document.getElementById('jk').value,
            tglLahir: document.getElementById('tglLahir').value,
            umur: document.getElementById('umur').value,
            dusun: document.getElementById('dusun').value,
            pendidikan: document.getElementById('pendidikan').value,
            pekerjaan: document.getElementById('pekerjaan').value,
            perkawinan: document.getElementById('perkawinan').value,
            agama: document.getElementById('agama').value,
            alamat: document.getElementById('alamat').value.trim()
        };

        const editIndex = inputEditIndex.value;
        if (editIndex === '') {
            dataPenduduk.push(data);
        } else {
            dataPenduduk[editIndex] = data;
        }
        renderTable();
        batalEdit();
        return false;
    }

    // Render tabel data penduduk
    function renderTable() {
        tableBody.innerHTML = '';
        dataPenduduk.forEach((item, idx) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="py-2 px-3">${item.nik}</td>
                <td class="py-2 px-3">${item.nokk}</td>
                <td class="py-2 px-3">${item.nama}</td>
                <td class="py-2 px-3">${item.jk}</td>
                <td class="py-2 px-3">${item.tglLahir}</td>
                <td class="py-2 px-3">${item.umur}</td>
                <td class="py-2 px-3">${item.dusun}</td>
                <td class="py-2 px-3">${item.pendidikan}</td>
                <td class="py-2 px-3">${item.pekerjaan}</td>
                <td class="py-2 px-3">${item.perkawinan}</td>
                <td class="py-2 px-3">${item.agama}</td>
                <td class="py-2 px-3">${item.alamat}</td>
                <td class="py-2 px-3">
                    <button onclick="editPenduduk(${idx})" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold mb-1"><i class="fas fa-edit"></i></button>
                    <button onclick="hapusPenduduk(${idx})" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-trash"></i></button>
                </td>
            `;
            tableBody.appendChild(tr);
        });
    }

    // Edit data penduduk
    window.editPenduduk = function(idx) {
        const item = dataPenduduk[idx];
        formTitle.textContent = 'Edit Data Penduduk';
        document.getElementById('nik').value = item.nik;
        document.getElementById('nokk').value = item.nokk;
        document.getElementById('nama').value = item.nama;
        document.getElementById('jk').value = item.jk;
        document.getElementById('tglLahir').value = item.tglLahir;
        document.getElementById('umur').value = item.umur;
        document.getElementById('dusun').value = item.dusun;
        document.getElementById('pendidikan').value = item.pendidikan;
        document.getElementById('pekerjaan').value = item.pekerjaan;
        document.getElementById('perkawinan').value = item.perkawinan;
        document.getElementById('agama').value = item.agama;
        document.getElementById('alamat').value = item.alamat;
        inputEditIndex.value = idx;
        formPenduduk.classList.remove('hidden');
        window.scrollTo({ top: formPenduduk.offsetTop - 80, behavior: 'smooth' });
    };

    // Hapus data penduduk
    window.hapusPenduduk = function(idx) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            dataPenduduk.splice(idx, 1);
            renderTable();
        }
    };
</script>
@endsection
