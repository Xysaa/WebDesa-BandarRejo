@extends('layouts.app')
@section('title', $artikel->title)

@section('content')
<div class="container mx-auto mt-10 flex flex-col md:flex-row gap-6 md:gap-8">

    <!-- Bagian Kiri: Artikel Lengkap -->
    <div class="flex-1 bg-white p-6 rounded-lg shadow-lg anim" style="--d:80ms;">
        <!-- Navigasi Breadcrumb -->
        <div class="text-xs sm:text-sm text-gray-500 mb-4 flex items-center space-x-2 anim" style="--d:120ms;">
            <a href="/" class="hover:text-blue-500 flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
            </a>
            /
            <a href="{{ route('berita.public') }}" class="hover:text-blue-500">Berita</a> /
            <span class="text-gray-700">{{ $artikel->title }}</span>
        </div>

        <!-- Judul Artikel -->
        <h2 class="text-3xl md:text-4xl font-extrabold text-black mb-6 anim" style="--d:160ms;">
            {{ $artikel->title }}
        </h2>

        <!-- Meta Informasi -->
        <div class="flex justify-between items-center mb-8 text-xs sm:text-sm text-gray-600 anim" style="--d:200ms;">
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2v10l4 2"></path>
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="font-semibold">{{ \Carbon\Carbon::parse($artikel->date)->translatedFormat('d M Y') }}</span>
                </div>

                <div class="flex items-center gap-2 text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm7 8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1 7 7 0 0 1 14 0Z"></path>
                    </svg>
                    <span class="font-semibold text-sm">{{ $artikel->author }}</span>
                </div>
            </div>

            <div class="flex items-center gap-2 text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5C7 5 2.73 8.11 1 12c1.73 3.89 6 7 11 7s9.27-3.11 11-7c-1.73-3.89-6-7-11-7Zm0 12a5 5 0 1 1 5-5 5 5 0 0 1-5 5Zm0-8a3 3 0 1 0 3 3 3 3 0 0 0-3-3Z"></path>
                </svg>
                <span class="text-sm">Dilihat {{ number_format($artikel->views) }} kali</span>
            </div>
        </div>

        <!-- Gambar Utama -->
        @if($artikel->image)
        <div class="overflow-hidden rounded-lg mb-5 md:mb-6">
            <img src="{{ asset('storage/' . $artikel->image) }}" alt="{{ $artikel->title }}"
                 class="w-full h-48 sm:h-64 md:h-80 object-contain rounded-lg hero-anim">
        </div>
        @endif

        <!-- Deskripsi Konten -->
        <p class="text-base sm:text-lg text-gray-800 mb-6 font-bold anim" style="--d:240ms;">
            {{ $artikel->description }}
        </p>

        <!-- Isi Artikel -->
        <div class="prose max-w-none mb-8 anim" style="--d:280ms;">
            <p class="whitespace-pre-line">{{ $artikel->isi }}</p>
        </div>
    </div>

    <!-- Bagian Kanan: Berita Lainnya -->
    <div class="w-full md:w-1/3 lg:w-1/4 md:min-w-[260px] bg-white p-6 rounded-lg shadow-lg sidebar-anim" style="--d:320ms;">
        <h3 class="text-xl font-bold text-black mb-6">Berita Lainnya</h3>
        <ul>
            @foreach($berita as $item)
                @if($item->slug != $artikel->slug)
                    <li class="mb-5 sm:mb-6 anim" style="--d:360ms;">
                        <a href="{{ route('berita.show', $item->slug) }}" class="flex items-center space-x-4 group">
                            @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                 class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-md flex-shrink-0 group-hover:scale-[1.02] transition-transform duration-300 ease-out">
                            @else
                            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gray-200 rounded-md flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            @endif
                            
                            <div>
                                <p class="text-sm font-semibold text-black mb-2 group-hover:text-blue-500 transition-colors duration-300 ease-out">
                                    {{ Str::limit($item->title, 50) }}
                                </p>
                                <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2v10l4 2"></path>
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-500 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 5C7 5 2.73 8.11 1 12c1.73 3.89 6 7 11 7s9.27-3.11 11-7c-1.73-3.89-6-7-11-7Zm0 12a5 5 0 1 1 5-5 5 5 0 0 1-5 5Zm0-8a3 3 0 1 0 3 3 3 3 0 0 0-3-3Z"></path>
                                    </svg>
                                    <span>{{ number_format($item->views) }} views</span>
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

{{-- Styling tetap sama --}}
<style>
@media (prefers-reduced-motion: reduce) {
  .anim, .sidebar-anim, .hero-anim {
    animation: none !important;
    transition: none !important;
    opacity: 1 !important;
    transform: none !important;
    filter: none !important;
  }
}

.anim, .sidebar-anim, .hero-anim {
  opacity: 0;
  will-change: opacity, transform;
}

@keyframes fadeUp {
  0% {
    opacity: 0;
    transform: translateY(6px);
    filter: blur(0.5px);
  }
  60% {
    opacity: 0.8;
    filter: blur(0px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
    filter: blur(0);
  }
}

@keyframes fadeRight {
  0% {
    opacity: 0;
    transform: translateX(8px);
    filter: blur(0.5px);
  }
  60% {
    opacity: 0.8;
    filter: blur(0px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
    filter: blur(0);
  }
}

@keyframes revealScale {
  0% {
    opacity: 0;
    transform: scale(0.99);
    filter: blur(0.5px);
  }
  60% {
    opacity: 0.9;
    filter: blur(0px);
  }
  100% {
    opacity: 1;
    transform: scale(1);
    filter: blur(0);
  }
}

.anim {
  animation: fadeUp 680ms cubic-bezier(0.16, 1, 0.3, 1) both;
  animation-delay: var(--d, 0ms);
}

.sidebar-anim {
  animation: fadeRight 700ms cubic-bezier(0.16, 1, 0.3, 1) both;
  animation-delay: var(--d, 0ms);
}

.hero-anim {
  animation: revealScale 750ms cubic-bezier(0.16, 1, 0.3, 1) both;
  animation-delay: 240ms;
}

.anim, .sidebar-anim, .hero-anim {
  backface-visibility: hidden;
  -webkit-font-smoothing: antialiased;
}

.prose {
  overflow-wrap: anywhere;
}

@media (max-width: 640px) {
  .prose p, .prose li {
    line-height: 1.6;
  }
}
</style>
