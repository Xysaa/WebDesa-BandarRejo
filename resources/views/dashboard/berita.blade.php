@extends('layouts.dashboard')

@section('title', 'Berita Desa')

@section('content')

<h2 class="text-3xl font-bold text-gray-800 mb-6">Berita & Kegiatan Desa</h2>

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

{{-- Tombol tambah berita --}}
<div class="mb-6">
    <a href="{{ route('dashboard.berita.create') }}" class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200 inline-block">
        <i class="fas fa-plus mr-2"></i> Tambah Berita Baru
    </a>
</div>

{{-- Daftar berita --}}
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="font-bold text-xl text-[#2C7961] mb-4">Daftar Berita</h3>
    
    @forelse($beritas as $berita)
        <div class="py-4 group relative border-b border-gray-200 last:border-0">
            <div class="flex items-start gap-4">
                @if($berita->image)
                    <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" class="w-24 h-24 object-cover rounded-lg flex-shrink-0">
                @else
                    <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                    </div>
                @endif
                
                <div class="flex-1">
                    <div class="font-semibold text-lg text-gray-800">{{ $berita->title }}</div>
                    <div class="text-gray-500 text-sm mb-1">
                        <i class="fas fa-calendar mr-1"></i> 
                        {{ \Carbon\Carbon::parse($berita->date)->translatedFormat('d F Y') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-user mr-1"></i> {{ $berita->author }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-eye mr-1"></i> {{ $berita->views }} views
                    </div>
                    <div class="text-gray-700 mt-2">{{ Str::limit($berita->description, 150) }}</div>
                </div>
            </div>
            
            <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                <a href="{{ route('dashboard.berita.edit', $berita->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm font-semibold">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <form action="{{ route('dashboard.berita.destroy', $berita->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-semibold">
                        <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-center py-8">
            <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
            <p class="text-gray-600 mb-4">Belum ada berita yang dipublikasikan.</p>
            
        </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($beritas->hasPages())
    <div class="mt-6">
        {{ $beritas->links() }}
    </div>
@endif

@endsection
