@extends('layouts.app')
@section('title', 'Berita Desa')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-10 font-poppins" id="berita-container">
  <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-700 mb-2 sm:mb-3">Berita Desa</h2>
  <p class="text-base sm:text-lg text-black mb-6 sm:mb-8">
    Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari Desa Bandar Rejo
  </p>

  {{-- Grid responsif: 1 kolom (mobile), 2 kolom (sm/md), 3 kolom (lg+) --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8 mb-8">
    @forelse($berita as $item)
      @php
        $dt   = \Carbon\Carbon::parse($item->date);
        $hari = $dt->format('d');
        $bln  = $dt->translatedFormat('M');
        $thn  = $dt->format('Y');
      @endphp

      <!-- Kartu Berita -->
      <a href="{{ route('berita.show', $item->slug) }}"
         class="relative bg-white rounded-xl shadow-md overflow-hidden ring-1 ring-slate-100 transition-transform duration-300 ease-out will-change-transform hover:shadow-lg md:hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-emerald-500/50">

        <!-- Gambar adaptif -->
        @if($item->image)
          <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
               loading="lazy"
               class="w-full h-40 sm:h-48 md:h-56 lg:h-60 object-cover">
        @else
          <div class="w-full h-40 sm:h-48 md:h-56 lg:h-60 bg-gray-200 flex items-center justify-center">
            <i class="fas fa-image text-gray-400 text-4xl"></i>
          </div>
        @endif

        <!-- Konten: TANPA padding kanan di mobile, baru sisihkan ruang di md+ -->
        <div class="p-4 sm:p-5 pr-0 md:pr-28 lg:pr-36 flex flex-col h-full">
          <h3 class="text-lg sm:text-xl font-semibold text-slate-900 hover:text-blue-600 transition-colors duration-200 title-clamp">
            {{ $item->title }}
          </h3>

          <p class="mt-2 text-slate-600 text-sm sm:text-base desc-clamp">
            {{ $item->description }}
          </p>

          <div class="mt-4 sm:mt-5 space-y-1 flex-grow">
            <div class="flex items-center gap-2 text-slate-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm7 8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1 7 7 0 0 1 14 0Z"/>
              </svg>
              <span class="text-xs sm:text-sm">{{ $item->author }}</span>
            </div>
            <div class="flex items-center gap-2 text-slate-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5C7 5 2.73 8.11 1 12c1.73 3.89 6 7 11 7s9.27-3.11 11-7c-1.73-3.89-6-7-11-7Zm0 12a5 5 0 1 1 5-5 5 5 0 0 1-5 5Zm0-8a3 3 0 1 0 3 3 3 3 0 0 0-3-3Z"/>
              </svg>
              <span class="text-xs sm:text-sm">Dilihat {{ number_format($item->views) }} kali</span>
            </div>
          </div>
        </div>

        <!-- Badge tanggal -->
        <div class="absolute bottom-0 right-0 z-10 bg-gradient-to-br from-emerald-600 to-emerald-300 text-white rounded-tl-xl rounded-br-xl px-3 sm:px-4 py-2 leading-tight text-center shadow-md ring-1 ring-emerald-500/20">
          <div class="text-xs font-semibold" style="font-family: 'Poppins', sans-serif;">{{ $hari }} {{ $bln }}</div>
          <div class="text-xs font-bold" style="font-family: 'Poppins', sans-serif;">{{ $thn }}</div>
        </div>
      </a>
    @empty
      <div class="col-span-full text-center py-12">
        <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
        <p class="text-gray-600 text-lg">Belum ada berita yang tersedia.</p>
      </div>
    @endforelse
  </div>
</div>

<script>
  // Animasi masuk halus
  document.addEventListener("DOMContentLoaded", function() {
    const beritaItems = document.querySelectorAll(".berita-item");

    // Memberikan delay agar setiap berita muncul satu per satu
    beritaItems.forEach((item, index) => {
      setTimeout(() => {
        item.classList.add("show");
      }, index * 150);
    });
  });
</script>

{{-- CSS untuk memastikan responsif dan item baris terakhir di tengah --}}
<style>
  /* Deskripsi ringkas 2 baris */
  .desc-clamp {
    display: -webkit-box;
    -webkit-line-clamp: 2;
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
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  /* Grid dengan 6 kolom (visual 3 kolom) - TEKNIK CENTERING LAST ROW */
  .berita-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 1.25rem;
  }

  /* Setiap item mengambil 2 kolom (6/2 = 3 item per baris) */
  .berita-item {
    grid-column: span 2;
    opacity: 1;
    transform: scale(1);
    transform-origin: center center;
    background-color: #fff;
    border: 1px solid #ddd;
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
  }

  /* State awal sebelum animasi */
  .berita-item:not(.show) {
    opacity: 0;
    transform: scale(0.5);
  }

  /* Setelah animasi selesai */
  .berita-item.show {
    opacity: 1;
    transform: scale(1);
  }

  /* CENTERING UNTUK 3 KOLOM LAYOUT */
  /* Jika item terakhir adalah item ke-1, 4, 7, 10... (sisa 1 item) */
  .berita-item:last-child:nth-child(3n + 1) {
    grid-column-end: 5; /* Mulai dari kolom 3, berakhir di kolom 5 (tengah) */
  }

  /* Jika ada 2 item di baris terakhir */
  /* Item kedua dari belakang yang ke-1, 4, 7, 10... */
  .berita-item:nth-last-child(2):nth-child(3n + 1) {
    grid-column-end: 4; /* Berakhir di kolom 4 */
  }

  /* Responsive breakpoints */
  @media (min-width: 640px) {
    .berita-grid {
      gap: 1.5rem;
    }
  }

  @media (min-width: 1024px) {
    .berita-grid {
      gap: 2rem;
    }
  }

  /* Responsive untuk mobile: 1 kolom */
  @media (max-width: 639px) {
    .berita-grid {
      grid-template-columns: 1fr;
    }

    .berita-item {
      grid-column: span 1;
    }

    /* Reset centering untuk mobile */
    .berita-item:last-child:nth-child(3n + 1),
    .berita-item:nth-last-child(2):nth-child(3n + 1) {
      grid-column-end: auto;
    }

    .title-clamp { -webkit-line-clamp: unset; }
  }

  /* Responsive untuk tablet: 2 kolom */
  @media (min-width: 640px) and (max-width: 1023px) {
    .berita-grid {
      grid-template-columns: repeat(4, 1fr);
    }

    .berita-item {
      grid-column: span 2;
    }

    /* Reset centering untuk 3 kolom */
    .berita-item:last-child:nth-child(3n + 1),
    .berita-item:nth-last-child(2):nth-child(3n + 1) {
      grid-column-end: auto;
    }

    /* Centering untuk 2 kolom layout */
    /* Jika item terakhir adalah item ganjil (sisa 1 item) */
    .berita-item:last-child:nth-child(2n + 1) {
      grid-column-end: 4; /* Tengah untuk 2 kolom */
    }

    .title-clamp { -webkit-line-clamp: unset; }
  }

  @media (min-width: 1024px) {
    .title-clamp { -webkit-line-clamp: unset; }
  }
</style>
@endsection
