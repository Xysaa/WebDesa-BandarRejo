@extends('layouts.app')
@section('title', 'Berita Desa')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-10 font-poppins opacity-0 -translate-y-10 transition-all duration-1000 ease-in-out" id="berita-container">
  <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-700 mb-2 sm:mb-3">Berita Desa</h2>
  <p class="text-base sm:text-lg text-black mb-6 sm:mb-8">
    Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari Desa Data
  </p>

  {{-- dummy data sementara; nanti ganti dari controller --}}
  @php
    $berita = [
      [
        'slug' => 'Berita1',
        'image' => 'images/gambar1.png',
        'title' => 'Survei Desa Bandar Rejo',
        'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
        'author' => 'Sigit Kurnia',
        'views' => 402,
        'date' => '2025-06-23',
      ],
      [
        'slug' => 'Berita2',
        'image' => 'images/gambar2.png',
        'title' => 'Survei Desa Bandar Rejo 2',
        'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
        'author' => 'Sigit Kurnia',
        'views' => 500,
        'date' => '2025-06-24',
      ],
      [
        'slug' => 'Berita3',
        'image' => 'images/gambar3.png',
        'title' => 'Survei Desa Bandar Rejo 3',
        'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
        'author' => 'Sigit Kurnia',
        'views' => 305,
        'date' => '2025-06-25',
      ],
      [
        'slug' => 'Berita4',
        'image' => 'images/gambar4.png',
        'title' => 'Survei Desa Bandar Rejo 4',
        'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
        'author' => 'Sigit Kurnia',
        'views' => 700,
        'date' => '2025-06-26',
      ],
      [
        'slug' => 'Berita5',
        'image' => 'images/gambar5.png',
        'title' => 'Survei Desa Bandar Rejo 5',
        'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
        'author' => 'Sigit Kurnia',
        'views' => 450,
        'date' => '2025-06-27',
      ],
      [
        'slug' => 'Berita6',
        'image' => 'images/gambar6.png',
        'title' => 'Survei Desa Bandar Rejo 6',
        'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
        'author' => 'Sigit Kurnia',
        'views' => 600,
        'date' => '2025-06-28',
      ],
    ];
  @endphp

  {{-- Grid responsif: 1 kolom (mobile), 2 kolom (sm/md), 3 kolom (lg+) --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8 mb-8">
    @foreach($berita as $item)
      @php
        $dt   = \Carbon\Carbon::parse($item['date']);
        $hari = $dt->format('d');
        $bln  = $dt->translatedFormat('M');
        $thn  = $dt->format('Y');
      @endphp

      <!-- Kartu Berita -->
      <a href="/berita/{{ $item['slug'] }} "
         class="relative bg-white rounded-xl shadow-md overflow-hidden ring-1 ring-slate-100 transition-transform duration-300 ease-out will-change-transform hover:shadow-lg md:hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
        <!-- Gambar adaptif -->
        <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}"
             loading="lazy"
             class="w-full h-40 sm:h-48 md:h-56 lg:h-60 object-cover">

        <!-- Konten: TANPA padding kanan di mobile, baru sisihkan ruang di md+ -->
        <div class="p-4 sm:p-5 pr-0 md:pr-28 lg:pr-36 flex flex-col h-full">
          <h3 class="text-lg sm:text-xl font-semibold text-slate-900 hover:text-blue-600 transition-colors duration-200 title-clamp">
            {{ $item['title'] }}
          </h3>

          <p class="mt-2 text-slate-600 text-sm sm:text-base desc-clamp">
            {{ $item['description'] }}
          </p>

          <div class="mt-4 sm:mt-5 space-y-1 flex-grow">
            <div class="flex items-center gap-2 text-slate-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm7 8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1 7 7 0 0 1 14 0Z"/>
              </svg>
              <span class="text-xs sm:text-sm">{{ $item['author'] }}</span>
            </div>
            <div class="flex items-center gap-2 text-slate-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5C7 5 2.73 8.11 1 12c1.73 3.89 6 7 11 7s9.27-3.11 11-7c-1.73-3.89-6-7-11-7Zm0 12a5 5 0 1 1 5-5 5 5 0 0 1-5 5Zm0-8a3 3 0 1 0 3 3 3 3 0 0 0-3-3Z"/>
              </svg>
              <span class="text-xs sm:text-sm">Dilihat {{ number_format($item['views']) }} kali</span>
            </div>
          </div>
        </div>

        <!-- Badge tanggal -->
        <div class="absolute bottom-0 right-0 z-10 bg-gradient-to-br from-emerald-600 to-emerald-300 text-white rounded-tl-xl rounded-br-xl px-3 sm:px-4 py-2 leading-tight text-center shadow-md ring-1 ring-emerald-500/20">
          <div class="text-xs font-semibold" style="font-family: 'Poppins', sans-serif;">{{ $hari }} {{ $bln }}</div>
          <div class="text-xs font-bold" style="font-family: 'Poppins', sans-serif;">{{ $thn }}</div>
        </div>
      </a>
    @endforeach
  </div>
</div>

<script>
  // Animasi masuk halus
  window.addEventListener("load", function() {
    const beritaContainer = document.getElementById("berita-container");
    beritaContainer.classList.remove("opacity-0", "-translate-y-10");
    beritaContainer.classList.add("opacity-100", "translate-y-0");
  });
</script>

{{-- CSS untuk memastikan responsif --}}
<style>
  /* Deskripsi ringkas 2 baris */
  .desc-clamp {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Atur jumlah baris deskripsi */
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Judul: Menyesuaikan lebar dengan kartu */
  .title-clamp {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-line-clamp: unset;
    word-break: break-word;
    white-space: normal;
  }

  /* Kartu berita responsive */
  .grid {
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Mengatur grid agar fleksibel */
  }

  @media (max-width: 640px) {
    .title-clamp { -webkit-line-clamp: unset; }
  }

  @media (min-width: 641px) and (max-width: 1024px) {
    .title-clamp { -webkit-line-clamp: unset; }
  }

  @media (min-width: 1025px) {
    .title-clamp { -webkit-line-clamp: unset; }
  }
</style>
@endsection
