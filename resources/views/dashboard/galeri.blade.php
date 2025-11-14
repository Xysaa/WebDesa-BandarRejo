@extends('layouts.dashboard')

@section('title', 'Galeri Foto')

@section('content')

<h2 class="text-3xl font-bold text-gray-800 mb-6">Galeri Foto Desa</h2>

{{-- Flash messages --}}
@if(session('success'))
  <div class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-green-700">
    {{ session('success') }}
  </div>
@endif
@if(session('error'))
  <div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-700">
    {{ session('error') }}
  </div>
@endif
@if ($errors->any())
  <div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-700">
    <ul class="list-disc list-inside text-sm">
      @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  </div>
@endif

{{-- Toolbar: cari + tambah --}}
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
  <form method="GET" action="{{ route('dashboard.galeri-foto.index') }}" class="flex items-center gap-2">
    <input
      name="q"
      value="{{ $q ?? '' }}"
      class="w-64 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#2C7961]"
      placeholder="Cari judul / tanggal (YYYY-MM-DD)...">
    <button class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded font-semibold">Cari</button>
    @if(!empty($q))
      <a href="{{ route('dashboard.galeri-foto.index') }}" class="border px-3 py-2 rounded text-gray-600 hover:bg-gray-50">Reset</a>
    @endif
  </form>

  <button id="showFormBtn"
          type="button"
          class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
    <i class="fas fa-plus mr-2"></i> Tambah Foto Baru
  </button>
</div>

{{-- Form tambah foto (inline, toggle) --}}
<div id="formTambahFoto" class="mb-8 hidden">
  <div class="bg-white rounded-lg shadow p-6 mb-4">
    <h3 class="font-bold text-lg mb-4 text-[#2C7961]">Tambah Foto Baru</h3>
    <form method="POST"
          action="{{ route('dashboard.galeri-foto.store') }}"
          enctype="multipart/form-data"
          class="space-y-4">
      @csrf
      <div>
        <label class="block text-gray-700 font-semibold mb-2">Judul Foto</label>
        <input type="text" name="judul" value="{{ old('judul') }}"
               class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#2C7961]" required>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
        <input type="date" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}"
               class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#2C7961]" required>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold mb-2">Pilih Gambar</label>
        <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp"
               class="w-full px-4 py-2 border rounded bg-white focus:outline-none focus:ring-2 focus:ring-[#2C7961]" required>
        <p class="text-xs text-gray-500 mt-1">Maks 3MB; format: JPG/PNG/WEBP.</p>
      </div>
      <div class="flex gap-2">
        <button type="submit" class="bg-[#2C7961] text-white px-4 py-2 rounded hover:bg-[#256952]">Simpan</button>
        <button type="button" onclick="tutupForm()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
      </div>
    </form>
  </div>
</div>

{{-- Form EDIT foto (inline, pakai view yang sama) --}}
@if(isset($editItem))
  <div class="mb-8">
    <div class="bg-white rounded-lg shadow p-6 mb-4 border border-yellow-300">
      <h3 class="font-bold text-lg mb-4 text-yellow-700">
        Edit Foto: {{ $editItem->judul }}
      </h3>
      <form method="POST"
            action="{{ route('dashboard.galeri-foto.update', $editItem) }}"
            enctype="multipart/form-data"
            class="space-y-4">
        @csrf
        @method('PUT')

        <div>
          <label class="block text-gray-700 font-semibold mb-2">Judul Foto</label>
          <input type="text" name="judul" value="{{ old('judul', $editItem->judul) }}"
                 class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
        </div>
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
          <input type="date" name="tanggal" value="{{ old('tanggal', $editItem->tanggal->toDateString()) }}"
                 class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
        </div>
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Gambar Saat Ini</label>
          @php
            $imgEdit = $editItem->gambar_path ? asset('storage/'.$editItem->gambar_path) : asset('images/placeholder.png');
          @endphp
          <img src="{{ $imgEdit }}" alt="{{ $editItem->judul }}" class="w-full max-w-xs rounded mb-3 border">
          <label class="block text-gray-700 font-semibold mb-2">Ganti Gambar (opsional)</label>
          <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp"
                 class="w-full px-4 py-2 border rounded bg-white focus:outline-none focus:ring-2 focus:ring-yellow-600">
          <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
        </div>
        <div class="flex gap-2">
          <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
          <a href="{{ route('dashboard.galeri-foto.index') }}"
             class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
        </div>
      </form>
    </div>
  </div>
@endif

{{-- DETAIL FOTO (lihat) --}}
@if(isset($showItem))
  <div class="mb-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
      @php
        $imgShow = $showItem->gambar_path ? asset('storage/'.$showItem->gambar_path) : asset('images/placeholder.png');
      @endphp
      <img src="{{ $imgShow }}" alt="{{ $showItem->judul }}" class="w-full max-h-[420px] object-contain bg-gray-50">
      <div class="p-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $showItem->judul }}</h3>
        <div class="text-gray-500 text-sm mb-3">
          Tanggal foto: {{ \Illuminate\Support\Carbon::parse($showItem->tanggal)->format('d M Y') }}<br>
          Diunggah pada: {{ $showItem->created_at?->format('d M Y H:i') }}
        </div>
        @if($showItem->updated_at && $showItem->updated_at->ne($showItem->created_at))
          <div class="text-xs text-gray-400 mb-3">
            Terakhir diperbarui: {{ $showItem->updated_at->format('d M Y H:i') }}
          </div>
        @endif

        <div class="flex gap-2 mt-2">
          <a href="{{ route('dashboard.galeri-foto.edit', $showItem) }}"
             class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm font-semibold">
            <i class="fas fa-edit mr-1"></i> Edit
          </a>
          <form method="POST" action="{{ route('dashboard.galeri-foto.destroy', $showItem) }}"
                onsubmit="return confirm('Hapus foto ini?')">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm font-semibold">
              <i class="fas fa-trash mr-1"></i> Hapus
            </button>
          </form>
          <a href="{{ route('dashboard.galeri-foto.index') }}"
             class="border border-gray-300 text-gray-700 px-4 py-2 rounded text-sm hover:bg-gray-50">
            Kembali ke daftar
          </a>
        </div>
      </div>
    </div>
  </div>
@endif

{{-- Grid galeri dari database --}}
@if($items->count())
  <div id="galeriGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach($items as $it)
      <div class="bg-white rounded-lg shadow p-2 group relative">
        @php
          $img = $it->gambar_path ? asset('storage/'.$it->gambar_path) : asset('images/placeholder.png');
          $tgl = \Illuminate\Support\Carbon::parse($it->tanggal)->format('d M Y');
        @endphp
        <img src="{{ $img }}" alt="{{ $it->judul }}" class="rounded-lg w-full h-48 object-cover mb-2">
        <div class="font-semibold text-gray-800">{{ $it->judul }}</div>
        <div class="text-gray-500 text-sm">{{ $tgl }}</div>

        <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
          {{-- Detail: panggil show(), tapi view-nya tetap dashboard.galeri --}}
          <a href="{{ route('dashboard.galeri-foto.show', $it) }}"
             class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs font-semibold" title="Detail">
            <i class="fas fa-eye"></i>
          </a>
          {{-- Edit: panggil edit(), view sama --}}
          <a href="{{ route('dashboard.galeri-foto.edit', $it) }}"
             class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold" title="Edit">
            <i class="fas fa-edit"></i>
          </a>
          {{-- Hapus --}}
          <form method="POST" action="{{ route('dashboard.galeri-foto.destroy', $it) }}"
                onsubmit="return confirm('Hapus foto ini?')">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold" title="Hapus">
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-6">
    {{ $items->onEachSide(1)->links() }}
  </div>
@else
  <div class="text-gray-500">Belum ada foto.</div>
@endif

{{-- JS: toggle form tambah --}}
<script>
  document.getElementById('showFormBtn').onclick = function() {
    const el = document.getElementById('formTambahFoto');
    el.classList.toggle('hidden');
    if (!el.classList.contains('hidden')) {
      window.scrollTo({ top: el.offsetTop - 80, behavior: 'smooth' });
    }
  };
  function tutupForm() {
    document.getElementById('formTambahFoto').classList.add('hidden');
    const form = document.querySelector('#formTambahFoto form');
    if (form) form.reset();
  }
</script>

@endsection