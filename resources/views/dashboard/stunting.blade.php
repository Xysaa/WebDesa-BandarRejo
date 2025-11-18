@extends('layouts.dashboard')

@section('title', 'Data Stunting')

@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-6">Data Stunting per Dusun</h2>

{{-- Tombol tambah data --}}
<div class="mb-6">
    <a href="{{ route('dashboard.stunting.create') }}" class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200 inline-block">
        <i class="fas fa-plus mr-2"></i> Tambah Data Stunting
    </a>
</div>

{{-- Alert Messages --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
            </svg>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
            </svg>
        </button>
    </div>
@endif

{{-- Grid data stunting dari database --}}
<div id="stuntingGrid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($dataStuntings as $stunting)
        <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition duration-300">
            <div class="text-2xl font-bold text-[#2C7961] mb-2">{{ $stunting->nama_dusun }}</div>
            
            <div class="text-5xl font-bold my-4 {{ $stunting->jumlah_anak_stunting > 0 ? 'text-red-600' : 'text-green-600' }}">
                {{ $stunting->jumlah_anak_stunting }}
            </div>
            
            <div class="text-gray-600 mb-2">Anak Stunting</div>
            
            @if($stunting->tahun)
                <div class="text-sm text-gray-500 mb-3">Tahun {{ $stunting->tahun }}</div>
            @endif
            
            @if($stunting->keterangan)
                <div class="text-sm text-gray-600 mb-4 line-clamp-2">
                    {{ Str::limit($stunting->keterangan, 60) }}
                </div>
            @endif
            
            <div class="flex gap-2 justify-center mt-4">
                </a>
                <a href="{{ route('dashboard.stunting.edit', $stunting->id) }}" 
                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded font-semibold transition duration-200 text-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('dashboard.stunting.destroy', $stunting->id) }}" 
                      method="POST" 
                      class="inline-block"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data stunting di {{ $stunting->nama_dusun }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-semibold transition duration-200 text-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
            <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Data Stunting</h3>
            <p class="text-gray-500 mb-4">Silakan klik tombol "Tambah Data Stunting" untuk menambahkan data baru.</p>
            
        </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($dataStuntings->hasPages())
    <div class="mt-8">
        {{ $dataStuntings->links() }}
    </div>
@endif

{{-- Statistik Total --}}
@if($dataStuntings->count() > 0)
    <div class="mt-8 bg-[#2C7961] text-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold mb-4">Ringkasan Data</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="text-center">
                <div class="text-3xl font-bold">{{ $dataStuntings->count() }}</div>
                <div class="text-sm">Dusun Tercatat</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold">{{ $dataStuntings->sum('jumlah_anak_stunting') }}</div>
                <div class="text-sm">Total Anak Stunting</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold">{{ number_format($dataStuntings->avg('jumlah_anak_stunting'), 1) }}</div>
                <div class="text-sm">Rata-rata per Dusun</div>
            </div>
        </div>
    </div>
@endif

<div class="mt-8 bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-bold text-[#2C7961] mb-4">Catatan & Tindak Lanjut</h3>
    <p class="text-gray-700">Data stunting di atas dapat digunakan untuk intervensi program kesehatan dan pemantauan perkembangan anak di setiap dusun. Pastikan data selalu diperbarui secara berkala untuk pemantauan yang optimal.</p>
</div>

@endsection
