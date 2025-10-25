@props([
    // Opsional: ganti dengan route() milik aplikasi Anda
    'homeUrl' => route('home', absolute: false) ?? url('/'),
    'profilUrl' => url('/profil-desa'),
    'infografisUrl' => url('/infografis'),
    'beritaUrl' => url('/berita'),
    'loginUrl' => url('/login'),
])

<nav class="w-full bg-[#2C7961] text-white font-poppins">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            {{-- Kiri: Logo + Nama --}}
            <a href="{{ $homeUrl }}" class="flex items-center gap-3 shrink-0">
                <img
                    src="{{ asset('images/Logo.png') }}"
                    alt="Logo Desa"
                    class="h-8 w-8 object-contain rounded-full"
                />
                <div class="leading-tight">
                    <div class="text-sm md:text-base font-semibold">Desa Bandar Rejo</div>
                    <div class="text-[11px] md:text-xs text-white/80">Kabupaten Lampung Selatan</div>
                </div>
            </a>

            {{-- Kanan: Menu --}}
            <ul class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <li>
                    <a href="{{ $homeUrl }}" class="hover:opacity-90 transition-opacity">Home</a>
                </li>
                <li>
                    <a href="{{ $profilUrl }}" class="hover:opacity-90 transition-opacity">Profil Desa</a>
                </li>
                <li>
                    <a href="{{ $infografisUrl }}" class="hover:opacity-90 transition-opacity">Infografis</a>
                </li>
                <li>
                    <a href="{{ $beritaUrl }}" class="hover:opacity-90 transition-opacity">Berita</a>
                </li>
                <li>
                    <a href="{{ $loginUrl }}" class="hover:opacity-90 transition-opacity">Login</a>
                </li>
            </ul>

            {{-- Tombol mobile --}}
            <button x-data @click="$refs.menu.classList.toggle('hidden')" class="md:hidden inline-flex items-center justify-center p-2 rounded text-white/90 hover:text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        {{-- Menu mobile --}}
        <div x-ref="menu" class="md:hidden hidden pb-3">
            <ul class="flex flex-col gap-2 text-sm font-semibold">
                <li><a href="{{ $homeUrl }}" class="block py-2">Home</a></li>
                <li><a href="{{ $profilUrl }}" class="block py-2">Profil Desa</a></li>
                <li><a href="{{ $infografisUrl }}" class="block py-2">Infografis</a></li>
                <li><a href="{{ $beritaUrl }}" class="block py-2">Berita</a></li>
            </ul>
        </div>
    </div>
</nav>
