@extends('layouts.dashboard')

@section('title', 'Edit Data Bansos')

@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Data Bantuan Sosial (Bansos)</h2>

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

<div class="bg-white rounded-lg shadow p-6 mb-4">
    <h3 class="font-bold text-lg mb-4 text-[#2C7961]">Edit Data Bansos</h3>

    <form
        method="POST"
        action="{{ route('dashboard.bansos.update', $item) }}"
    >
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Jenis Bansos</label>
            <select
                name="jenis_bansos"
                class="w-full px-4 py-2 border rounded"
                required
            >
                <option value="" disabled>Pilih Jenis Bansos</option>
                @php
                    $jenis = old('jenis_bansos', $item->jenis_bansos);
                @endphp
                <option value="PKH"     {{ $jenis === 'PKH' ? 'selected' : '' }}>PKH</option>
                <option value="BPNT"    {{ $jenis === 'BPNT' ? 'selected' : '' }}>BPNT</option>
                <option value="PIP"     {{ $jenis === 'PIP' ? 'selected' : '' }}>PIP</option>
                <option value="JKN-KIS" {{ $jenis === 'JKN-KIS' ? 'selected' : '' }}>JKN-KIS</option>
                <option value="BLT"     {{ $jenis === 'BLT' ? 'selected' : '' }}>BLT</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Jumlah</label>
            <input
                type="number"
                name="jumlah"
                class="w-full px-4 py-2 border rounded"
                required
                min="1"
                value="{{ old('jumlah', $item->jumlah) }}"
            >
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Satuan</label>
            @php
                $satuan = old('satuan', $item->satuan);
            @endphp
            <select
                name="satuan"
                class="w-full px-4 py-2 border rounded"
                required
            >
                <option value="Keluarga" {{ $satuan === 'Keluarga' ? 'selected' : '' }}>Keluarga</option>
                <option value="Anak"     {{ $satuan === 'Anak' ? 'selected' : '' }}>Anak</option>
                <option value="Jiwa"     {{ $satuan === 'Jiwa' ? 'selected' : '' }}>Jiwa</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit"
                    class="bg-[#2C7961] text-white px-4 py-2 rounded hover:bg-[#256952]">
                Simpan Perubahan
            </button>
            <a href="{{ route('dashboard.bansos.index') }}"
               class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
