@extends('layouts.dashboard')

@section('title', 'Tambah Data Stunting')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('dashboard.stunting.index') }}" class="text-[#2C7961] hover:text-[#256952] font-semibold">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Data
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <h3 class="text-2xl font-bold text-[#2C7961] mb-6">Tambah Data Stunting Baru</h3>
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Terdapat kesalahan!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.stunting.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label for="nama_dusun" class="block text-gray-700 font-semibold mb-2">
                    Nama Dusun <span class="text-red-500">*</span>
                </label>

                <select
                    id="nama_dusun"
                    name="nama_dusun"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2C7961] focus:border-transparent @error('nama_dusun') border-red-500 @enderror"
                    required
                >
                    <option value="">-- Pilih Dusun --</option>
                    @for ($i = 1; $i <= 7; $i++)
                        <option value="Dusun {{ $i }}" {{ old('nama_dusun') == "Dusun $i" ? 'selected' : '' }}>
                            Dusun {{ $i }}
                        </option>
                    @endfor
                </select>

                @error('nama_dusun')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-6">
                <label for="jumlah_anak_stunting" class="block text-gray-700 font-semibold mb-2">
                    Jumlah Anak Stunting <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       id="jumlah_anak_stunting" 
                       name="jumlah_anak_stunting" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2C7961] focus:border-transparent @error('jumlah_anak_stunting') border-red-500 @enderror" 
                       min="0" 
                       value="{{ old('jumlah_anak_stunting', 0) }}"
                       required>
                @error('jumlah_anak_stunting')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tahun" class="block text-gray-700 font-semibold mb-2">Tahun</label>
                <input type="number" 
                       id="tahun" 
                       name="tahun" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2C7961] focus:border-transparent @error('tahun') border-red-500 @enderror" 
                       min="2000" 
                       max="{{ date('Y') + 1 }}" 
                       value="{{ old('tahun', date('Y')) }}"
                       placeholder="{{ date('Y') }}">
                @error('tahun')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="keterangan" class="block text-gray-700 font-semibold mb-2">Keterangan</label>
                <textarea id="keterangan" 
                          name="keterangan" 
                          rows="4" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2C7961] focus:border-transparent @error('keterangan') border-red-500 @enderror" 
                          placeholder="Tambahkan catatan atau keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-[#2C7961] text-white px-6 py-3 rounded-lg hover:bg-[#256952] font-semibold transition duration-200">
                    <i class="fas fa-save mr-2"></i> Simpan Data
                </button>
                <a href="{{ route('dashboard.stunting.index') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-semibold transition duration-200">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
