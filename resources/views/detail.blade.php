@extends('layouts.app')
@section('title', $artikel['title'])

@section('content')
<div class="container mx-auto mt-10 flex flex-col md:flex-row gap-6 md:gap-8">

    <!-- Bagian Kiri: Artikel Lengkap -->
    <div class="flex-1 bg-white p-6 rounded-lg shadow-lg anim" style="--d:80ms;">
        <!-- Navigasi Breadcrumb -->
        <div class="text-xs sm:text-sm text-gray-500 mb-4 flex items-center space-x-2 anim" style="--d:120ms;">
            <!-- Home (ikon saja) -->
            <a href="/" class="hover:text-blue-500 flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
            </a>
            /
            <a href="/berita" class="hover:text-blue-500">Berita</a> /
            <span class="text-gray-700">{{ $artikel['title'] }}</span>
        </div>

        <!-- Judul Artikel -->
        <h2 class="text-3xl md:text-4xl font-extrabold text-black mb-6 anim" style="--d:160ms;">
            {{ $artikel['title'] }}
        </h2>

        <!-- Meta Informasi (Tanggal, Author, Views) -->
        <div class="flex justify-between items-center mb-8 text-xs sm:text-sm text-gray-600 anim" style="--d:200ms;">
            <!-- Kiri: Tanggal & Author -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2v10l4 2"></path>
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="font-semibold">{{ \Carbon\Carbon::parse($artikel['date'])->format('d M Y') }}</span>
                </div>

                <div class="flex items-center gap-2 text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm7 8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1 7 7 0 0 1 14 0Z"></path>
                    </svg>
                    <span class="font-semibold text-sm">{{ $artikel['author'] }}</span>
                </div>
            </div>

            <!-- Kanan: Views -->
            <div class="flex items-center gap-2 text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5C7 5 2.73 8.11 1 12c1.73 3.89 6 7 11 7s9.27-3.11 11-7c-1.73-3.89-6-7-11-7Zm0 12a5 5 0 1 1 5-5 5 5 0 0 1-5 5Zm0-8a3 3 0 1 0 3 3 3 3 0 0 0-3-3Z"></path>
                </svg>
                <span class="text-sm">Dilihat {{ number_format($artikel['views']) }} kali</span>
            </div>
        </div>

        <!-- Gambar Utama -->
        <div class="overflow-hidden rounded-lg mb-5 md:mb-6">
            <img src="{{ asset($artikel['image']) }}" alt="{{ $artikel['title'] }}"
                 class="w-full h-48 sm:h-64 md:h-80 object-contain rounded-lg hero-anim">
        </div>

        <!-- Deskripsi Konten -->
        <p class="text-base sm:text-lg text-gray-800 mb-6 font-bold anim" style="--d:240ms;">
            {{ $artikel['description'] }}
        </p>

        <!-- Isi Artikel -->
        <div class="prose max-w-none mb-8 anim" style="--d:280ms;">
            <p>{{$artikel['isi']}}</p>
        </div>
    </div>

    <!-- Bagian Kanan: Berita Lainnya -->
    <div class="w-full md:w-1/3 lg:w-1/4 md:min-w-[260px] bg-white p-6 rounded-lg shadow-lg sidebar-anim" style="--d:320ms;">
        <h3 class="text-xl font-bold text-black mb-6">Berita Lainnya</h3>
        <ul>
            @foreach($berita as $item)
                @if($item['slug'] != $artikel['slug'])
                    <li class="mb-5 sm:mb-6 anim" style="--d:360ms;">
                        <a href="/berita/{{ $item['slug'] }}" class="flex items-center space-x-4 group">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}"
                                 class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-md flex-shrink-0 group-hover:scale-[1.02] transition-transform duration-300 ease-out">
                            <div>
                                <p class="text-sm font-semibold text-black mb-2 group-hover:text-blue-500 transition-colors duration-300 ease-out">
                                    {{ $item['title'] }}
                                </p>
                                <!-- Tanggal Rilis -->
                                <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2v10l4 2"></path>
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($item['date'])->format('d M Y') }}</span>
                                </div>
                                <!-- Views -->
                                <div class="flex items-center gap-2 text-xs text-slate-500 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 5C7 5 2.73 8.11 1 12c1.73 3.89 6 7 11 7s9.27-3.11 11-7c-1.73-3.89-6-7-11-7Zm0 12a5 5 0 1 1 5-5 5 5 0 0 1-5 5Zm0-8a3 3 0 1 0 3 3 3 3 0 0 0-3-3Z"></path>
                                    </svg>
                                    <span>{{ number_format($item['views']) }} views</span>
                                </div>
                            </div>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
@endsection

{{-- =================== INLINE STYLE: TETAP DI FILE INI =================== --}}
<style>
/* Hormati prefers-reduced-motion agar ramah aksesibilitas */
@media (prefers-reduced-motion: reduce) {
  .anim, .sidebar-anim, .hero-anim {
    animation: none !important;
    transition: none !important;
    opacity: 1 !important;
    transform: none !important;
    filter: none !important;
  }
}

/* State awal sebelum animasi berjalan */
.anim, .sidebar-anim, .hero-anim { opacity: 0; }

/* Keyframes elegan */
@keyframes fadeUp {
  0% { opacity: 0; transform: translateY(10px); filter: blur(2px); }
  100% { opacity: 1; transform: translateY(0); filter: blur(0); }
}
@keyframes fadeRight {
  0% { opacity: 0; transform: translateX(10px); filter: blur(2px); }
  100% { opacity: 1; transform: translateX(0); filter: blur(0); }
}
@keyframes revealScale {
  0% { opacity: 0; transform: scale(0.985); filter: blur(2px); }
  100% { opacity: 1; transform: scale(1); filter: blur(0); }
}

/* Jalankan animasi otomatis saat render */
.anim {
  animation: fadeUp 620ms cubic-bezier(.22,.61,.36,1) both;
  animation-delay: var(--d, 0ms);
}
.sidebar-anim {
  animation: fadeRight 640ms cubic-bezier(.22,.61,.36,1) both;
  animation-delay: var(--d, 0ms);
}
.hero-anim {
  animation: revealScale 720ms cubic-bezier(.16,.84,.44,1) both;
  animation-delay: 260ms;
}

/* Responsivitas tambahan agar tidak “kegencet” di layar kecil */
.prose { overflow-wrap: anywhere; }
@media (max-width: 640px) {
  .prose p, .prose li { line-height: 1.6; }
}
</style>
