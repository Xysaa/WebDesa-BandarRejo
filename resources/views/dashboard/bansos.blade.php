@extends('layouts.dashboard')

@section('title', 'Data Bansos')

@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-6">Data Bantuan Sosial (Bansos)</h2>

{{-- Flash message --}}
@if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
        <form id="bansosForm"
              method="POST"
              action="{{ route('dashboard.bansos.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jenis Bansos</label>
                <select id="jenisBansos" name="jenis_bansos" class="w-full px-4 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Jenis Bansos</option>
                    <option value="PKH" {{ old('jenis_bansos') == 'PKH' ? 'selected' : '' }}>PKH</option>
                    <option value="BPNT" {{ old('jenis_bansos') == 'BPNT' ? 'selected' : '' }}>BPNT</option>
                    <option value="PIP" {{ old('jenis_bansos') == 'PIP' ? 'selected' : '' }}>PIP</option>
                    <option value="JKN-KIS" {{ old('jenis_bansos') == 'JKN-KIS' ? 'selected' : '' }}>JKN-KIS</option>
                    <option value="BLT" {{ old('jenis_bansos') == 'BLT' ? 'selected' : '' }}>BLT</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                <input type="number"
                       id="jumlahBansos"
                       name="jumlah"
                       class="w-full px-4 py-2 border rounded"
                       required
                       min="1"
                       value="{{ old('jumlah', 1) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Satuan</label>
                <select id="satuanBansos" name="satuan" class="w-full px-4 py-2 border rounded" required>
                    <option value="Keluarga" {{ old('satuan') == 'Keluarga' ? 'selected' : '' }}>Keluarga</option>
                    <option value="Anak" {{ old('satuan') == 'Anak' ? 'selected' : '' }}>Anak</option>
                    <option value="Jiwa" {{ old('satuan') == 'Jiwa' ? 'selected' : '' }}>Jiwa</option>
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
            @forelse($items as $row)
                <tr>
                    <td class="py-3 px-4">{{ $row->jenis_bansos }}</td>
                    <td class="py-3 px-4 text-center">
                        <span class="jumlah">{{ $row->jumlah }}</span>
                    </td>
                    <td class="py-3 px-4 text-center">{{ $row->satuan }}</td>
                    <td class="py-3 px-4 text-center">
    <a href="{{ route('dashboard.bansos.edit', $row) }}"
       class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold inline-block">
        <i class="fas fa-edit"></i>
    </a>

    <form action="{{ route('dashboard.bansos.destroy', $row) }}"
          method="POST"
          class="inline-block"
          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 px-4 text-center text-gray-500">
                        Belum ada data bansos.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($items, 'links'))
    <div class="mt-4">
        {{ $items->onEachSide(1)->links() }}
    </div>
@endif

<div class="mt-8">
    <h3 class="text-xl font-bold text-[#2C7961] mb-4">Keterangan</h3>
    <p class="text-gray-700">Data bansos di atas dapat diupdate sesuai realisasi penyaluran bantuan di desa.</p>
</div>

<script>
    // Tampilkan form tambah bansos
    document.getElementById('showFormBtn').onclick = function() {
        const form = document.getElementById('formTambahBansos');
        form.classList.remove('hidden');
        window.scrollTo({ top: form.offsetTop - 80, behavior: 'smooth' });
    };

    // Tutup form tambah bansos
    function tutupForm() {
        document.getElementById('formTambahBansos').classList.add('hidden');
        document.getElementById('bansosForm').reset();
    }
</script>
@endsection
