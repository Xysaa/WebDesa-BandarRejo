@extends('layouts.dashboard')

@section('title', 'Edit Potensi Desa')

@section('content')

<div class="max-w-2xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Potensi</h2>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('dashboard.potensi.update', $potensiDesa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="judul_potensi" class="block text-gray-700 font-semibold mb-2">
                    Judul Potensi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="judul_potensi" 
                    name="judul_potensi" 
                    value="{{ old('judul_potensi', $potensiDesa->judul_potensi) }}"
                    class="w-full px-4 py-2 border rounded @error('judul_potensi') border-red-500 @enderror" 
                    placeholder="Masukkan judul potensi"
                >
                @error('judul_potensi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi" 
                    rows="5" 
                    class="w-full px-4 py-2 border rounded @error('deskripsi') border-red-500 @enderror" 
                    placeholder="Masukkan deskripsi potensi"
                >{{ old('deskripsi', $potensiDesa->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                @if($potensiDesa->gambar)
                    <label class="block text-gray-700 font-semibold mb-2">Gambar Saat Ini</label>
                    <img src="{{ asset('storage/' . $potensiDesa->gambar) }}" alt="{{ $potensiDesa->judul_potensi }}" class="w-48 h-32 object-cover rounded mb-3">
                @endif
                
                <label for="gambar" class="block text-gray-700 font-semibold mb-2">
                    {{ $potensiDesa->gambar ? 'Ganti Gambar' : 'Upload Gambar' }} 
                    <span class="text-gray-500 text-sm">(jpeg, png, jpg, gif - max 2MB)</span>
                </label>
                <input 
                    type="file" 
                    id="gambar" 
                    name="gambar" 
                    accept="image/*" 
                    class="w-full px-4 py-2 border rounded bg-white @error('gambar') border-red-500 @enderror"
                >
                @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex gap-2">
                <button type="submit" class="bg-[#2C7961] text-white px-6 py-2 rounded hover:bg-[#256952] font-semibold transition">
                    <i class="fas fa-save mr-2"></i> Update
                </button>
                <a href="{{ route('dashboard.potensi.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 font-semibold transition inline-block">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
