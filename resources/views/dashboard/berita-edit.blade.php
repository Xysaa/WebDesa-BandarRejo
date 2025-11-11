@extends('layouts.dashboard')

@section('title', 'Edit Berita')

@section('content')

<div class="max-w-3xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Berita</h2>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('dashboard.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold mb-2">
                    Judul Berita <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $berita->title) }}"
                    class="w-full px-4 py-2 border rounded @error('title') border-red-500 @enderror" 
                    placeholder="Masukkan judul berita"
                >
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-gray-700 font-semibold mb-2">
                    Slug <span class="text-gray-500 text-sm">(Opsional)</span>
                </label>
                <input 
                    type="text" 
                    id="slug" 
                    name="slug" 
                    value="{{ old('slug', $berita->slug) }}"
                    class="w-full px-4 py-2 border rounded @error('slug') border-red-500 @enderror" 
                    placeholder="berita-judul-otomatis"
                >
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">
                    Ringkasan/Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3" 
                    maxlength="500"
                    class="w-full px-4 py-2 border rounded @error('description') border-red-500 @enderror" 
                    placeholder="Ringkasan singkat berita (max 500 karakter)"
                >{{ old('description', $berita->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="isi" class="block text-gray-700 font-semibold mb-2">
                    Isi Berita <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="isi" 
                    name="isi" 
                    rows="8" 
                    class="w-full px-4 py-2 border rounded @error('isi') border-red-500 @enderror" 
                    placeholder="Tulis isi berita lengkap di sini"
                >{{ old('isi', $berita->isi) }}</textarea>
                @error('isi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="author" class="block text-gray-700 font-semibold mb-2">
                        Penulis <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="author" 
                        name="author" 
                        value="{{ old('author', $berita->author) }}"
                        class="w-full px-4 py-2 border rounded @error('author') border-red-500 @enderror" 
                        placeholder="Nama penulis"
                    >
                    @error('author')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date" class="block text-gray-700 font-semibold mb-2">
                        Tanggal Publikasi <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="date" 
                        name="date" 
                        value="{{ old('date', $berita->date->format('Y-m-d')) }}"
                        class="w-full px-4 py-2 border rounded @error('date') border-red-500 @enderror"
                    >
                    @error('date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-4">
                @if($berita->image)
                    <label class="block text-gray-700 font-semibold mb-2">Gambar Saat Ini</label>
                    <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" class="w-64 h-40 object-cover rounded mb-3">
                @endif
                
                <label for="image" class="block text-gray-700 font-semibold mb-2">
                    {{ $berita->image ? 'Ganti Gambar' : 'Upload Gambar' }} 
                    <span class="text-gray-500 text-sm">(jpeg, png, jpg, gif - max 2MB)</span>
                </label>
                <input 
                    type="file" 
                    id="image" 
                    name="image" 
                    accept="image/*" 
                    class="w-full px-4 py-2 border rounded bg-white @error('image') border-red-500 @enderror"
                >
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex gap-2">
                <button type="submit" class="bg-[#2C7961] text-white px-6 py-2 rounded hover:bg-[#256952] font-semibold transition">
                    <i class="fas fa-save mr-2"></i> Update
                </button>
                <a href="{{ route('dashboard.berita.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 font-semibold transition inline-block">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
