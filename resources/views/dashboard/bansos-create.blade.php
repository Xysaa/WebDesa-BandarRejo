@extends('layouts.dashboard')

@section('title', 'Tambah Data Bansos')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-[#2C7961] mb-6">
        Tambah Data Bantuan Sosial
    </h2>

    {{-- Flash error/success --}}
    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
            <p class="font-semibold mb-1">Terjadi kesalahan:</p>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('dashboard.bansos.store') }}" class="space-y-4">
            @csrf

            {{-- Jenis Bansos --}}
            <div>
                <label for="jenis_bansos" class="block text-sm font-semibold text-gray-700 mb-1">
                    Jenis Bansos
                </label>
                <input
                    type="text"
                    id="jenis_bansos"
                    name="jenis_bansos"
                    value="{{ old('jenis_bansos') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#2C7961]"
                    placeholder="Contoh: Paket Sembako, BLT, Beras 10kg"
                    required
                >
            </div>

            {{-- Jumlah --}}
            <div>
                <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-1">
                    Jumlah
                </label>
                <input
                    type="number"
                    id="jumlah"
                    name="jumlah"
                    value="{{ old('jumlah') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#2C7961]"
                    placeholder="Contoh: 50"
                    min="0"
                    required
                >
            </div>

            {{-- Satuan --}}
            <div>
                <label for="satuan" class="block text-sm font-semibold text-gray-700 mb-1">
                    Satuan
                </label>
                <input
                    type="text"
                    id="satuan"
                    name="satuan"
                    value="{{ old('satuan') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#2C7961]"
                    placeholder="Contoh: paket, KK, kg"
                    required
                >
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button
                    type="submit"
                    class="bg-[#2C7961] hover:bg-[#256952] text-white font-semibold px-5 py-2 rounded-md transition"
                >
                    Simpan
                </button>

                <a
                    href="{{ route('dashboard.bansos.index') }}"
                    class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-50"
                >
                    Batal / Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
