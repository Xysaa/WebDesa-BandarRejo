@props([
    'homeUrl'       => route('home', absolute: false) ?? url('/'),
    'profilUrl'     => url('/profil-desa'),
    'infografisUrl' => url('/infografis'),
    'beritaUrl'     => url('/berita'),
    'loginUrl'      => url('/login'),
])

<nav class="fixed top-0 inset-x-0 z-50 w-full bg-[#2C7961] text-white font-poppins shadow-sm">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            {{-- Logo + Nama --}}
            <a href="{{ $homeUrl }}" class="flex items-center gap-3 shrink-0">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo Desa"
                     class="h-8 w-8 object-contain rounded-full bg-white/10 ring-1 ring-white/20" />
                <div class="leading-tight">
                    <div class="text-sm md:text-base font-semibold">Desa Bandar Rejo</div>
                    <div class="text-[11px] md:text-xs text-white/80">Kabupaten Lampung Selatan</div>
                </div>
            </a>

            {{-- Menu Desktop (md+) --}}
            <ul class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <li><a href="{{ $homeUrl }}" class="hover:opacity-90 transition-opacity">Home</a></li>
                <li><a href="{{ $profilUrl }}" class="hover:opacity-90 transition-opacity">Profil Desa</a></li>
                <li><a href="{{ $infografisUrl }}" class="hover:opacity-90 transition-opacity">Infografis</a></li>
                <li><a href="{{ $beritaUrl }}" class="hover:opacity-90 transition-opacity">Berita</a></li>
                <li>
                    <a href="{{ $loginUrl }}"
                       class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md ring-1 ring-white/30 hover:bg-white/10 transition">
                        Login
                    </a>
                </li>
            </ul>

            {{-- Tombol Hamburger (mobile) --}}
            <button
                id="hamburgerBtn"
                type="button"
                class="md:hidden inline-flex items-center justify-center h-10 w-10 rounded focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60"
                aria-label="Toggle menu"
            >
                {{-- ikon hamburger --}}
                <svg id="iconOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                {{-- ikon close --}}
                <svg id="iconClose" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Menu Mobile --}}
        <div id="mobileMenu" class="hidden md:hidden bg-[#2C7961] border-t border-white/10">
            <ul class="flex flex-col text-sm font-semibold py-2">
                <li><a href="{{ $homeUrl }}" class="block py-2 px-3 hover:bg-white/10 transition-colors">Home</a></li>
                <li><a href="{{ $profilUrl }}" class="block py-2 px-3 hover:bg-white/10 transition-colors">Profil Desa</a></li>
                <li><a href="{{ $infografisUrl }}" class="block py-2 px-3 hover:bg-white/10 transition-colors">Infografis</a></li>
                <li><a href="{{ $beritaUrl }}" class="block py-2 px-3 hover:bg-white/10 transition-colors">Berita</a></li>
                <li class="pt-1"><a href="{{ $loginUrl }}" class="block py-2 px-3 hover:bg-white/10 transition-colors">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

{{-- Spacer agar konten tidak tertutup navbar fixed --}}
<div class="h-16"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const iconOpen = document.getElementById('iconOpen');
        const iconClose = document.getElementById('iconClose');

        if (hamburgerBtn && mobileMenu && iconOpen && iconClose) {
            hamburgerBtn.addEventListener('click', function() {
                // Toggle menu
                mobileMenu.classList.toggle('hidden');
                
                // Toggle icons
                iconOpen.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInside = hamburgerBtn.contains(event.target) || mobileMenu.contains(event.target);
                
                if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                }
            });

            // Close menu when window is resized to desktop size
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    mobileMenu.classList.add('hidden');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                }
            });
        }
    });
</script>