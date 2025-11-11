@extends('layouts.dashboard')

@section('title', 'Potensi Desa')

@section('content')

<h2 class="text-3xl font-bold text-gray-800 mb-6">Potensi Desa Bandar Rejo</h2>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

{{-- Tombol tambah potensi --}}
<div class="mb-6">
    <a href="{{ route('dashboard.potensi.create') }}" class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200 inline-block">
        <i class="fas fa-plus mr-2"></i> Tambah Potensi Baru
    </a>
</div>

{{-- Grid potensi desa --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($potensiDesas as $potensi)
        <div class="bg-white rounded-lg shadow p-6">
            @if($potensi->gambar)
                <img src="{{ asset('storage/' . $potensi->gambar) }}" alt="{{ $potensi->judul_potensi }}" class="w-full h-40 object-cover rounded mb-4">
            @else
                <div class="w-full h-40 bg-gray-200 rounded mb-4 flex items-center justify-center">
                    <span class="text-gray-400">No Image</span>
                </div>
            @endif
            
            <h3 class="font-bold text-xl text-[#2C7961] mb-2">{{ $potensi->judul_potensi }}</h3>
            <p class="text-gray-700 mb-4">{{ Str::limit($potensi->deskripsi, 150) }}</p>
            
            <div class="flex gap-2">
                <a href="{{ route('dashboard.potensi.edit', $potensi->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded font-semibold transition">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <form action="{{ route('dashboard.potensi.destroy', $potensi->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus potensi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded font-semibold transition">
                        <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-2 text-center py-8">
            <p class="text-gray-600 mb-4">Belum ada potensi desa yang ditambahkan.</p>
            <a href="{{ route('dashboard.potensi.create') }}" class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition inline-block">
                <i class="fas fa-plus mr-2"></i> Tambah Potensi Pertama
            </a>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($potensiDesas->hasPages())
    <div class="mt-8">
        {{ $potensiDesas->links() }}
    </div>
@endif

@endsection
