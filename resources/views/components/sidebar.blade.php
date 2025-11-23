@php
    $user = auth()->user();
    $role = $user->role ?? null;

    $isPendudukOpen =
        request()->routeIs('dashboard.penduduk*') ||
        request()->routeIs('dashboard.pekerjaan.*') ||
        false;
@endphp

{{-- Hamburger Button (Mobile Only) - Menggunakan vanilla JS --}}
<button onclick="toggleSidebar()" id="hamburgerBtn"
        class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-lg bg-[#2C7961] text-white shadow-lg">
    <i class="fas fa-bars text-xl"></i>
</button>

{{-- Overlay (Mobile Only) --}}
<div onclick="closeSidebar()" id="sidebarOverlay"
     class="lg:hidden hidden fixed inset-0 bg-black/50 z-30"></div>

{{-- Sidebar --}}
<aside id="sidebar"
       class="w-64 bg-[#2C7961] text-white min-h-screen flex flex-col shadow-lg
              fixed lg:static top-0 left-0 z-40 
              -translate-x-full lg:translate-x-0
              transition-transform duration-300 ease-in-out">
    
    {{-- Close Button (Mobile Only) --}}
    <button onclick="closeSidebar()" 
            class="lg:hidden absolute top-4 right-4 text-white hover:text-gray-300">
        <i class="fas fa-times text-xl"></i>
    </button>

    <div class="p-6 border-b border-white/10 text-center">
        <img src="{{ asset('images/Logo.png') }}" class="h-12 w-12 rounded-full bg-white p-1 mx-auto mb-2">
        <div class="font-bold text-xl">Desa Bandarejo</div>
        <div class="text-sm text-white/70">Dasbor {{ $role === 'kepala_dusun' ? 'Kepala Dusun' : 'Admin' }}</div>
    </div>

    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">

        {{-- MENU KHUSUS ADMIN --}}
        @if ($role === 'admin')
            <a href="{{ route('dashboard.index') }}"
               onclick="closeSidebar()"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.index') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
        @endif

        {{-- MENU ADMIN + KADUS --}}
        @if (in_array($role, ['admin', 'kepala_dusun']))

            {{-- DROPDOWN DATA PENDUDUK --}}
            <div class="space-y-1">

                <button data-dropdown-trigger="penduduk"
                    class="w-full flex items-center justify-between px-4 py-2 rounded-lg hover:bg-[#256952] transition
                           {{ $isPendudukOpen ? 'bg-[#256952] font-semibold' : '' }}">
                    <span><i class="fas fa-users mr-2"></i> Data Penduduk</span>
                    <i class="fas fa-chevron-down text-sm transition-transform {{ $isPendudukOpen ? 'rotate-180' : '' }}"
                       data-dropdown-icon="penduduk"></i>
                </button>

                <div data-dropdown-content="penduduk" class="pl-6 space-y-1 {{ $isPendudukOpen ? '' : 'hidden' }}">

                    <a href="{{ route('dashboard.penduduk') }}"
                       onclick="closeSidebar()"
                       class="block px-3 py-1.5 rounded hover:bg-[#256952]/50 transition
                              {{ request()->routeIs('dashboard.penduduk') ? 'bg-[#256952]/50 font-semibold' : '' }}">
                        Ringkasan
                    </a>

                    <a href="{{ route('dashboard.pekerjaan.index') }}"
                       onclick="closeSidebar()"
                       class="block px-3 py-1.5 rounded hover:bg-[#256952]/50 transition
                              {{ request()->routeIs('dashboard.pekerjaan.*') ? 'bg-[#256952]/50 font-semibold' : '' }}">
                        Pekerjaan
                    </a>
                </div>
            </div>

            {{-- BANSOS --}}
            <a href="{{ route('dashboard.bansos.index') }}"
               onclick="closeSidebar()"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.bansos.*') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-hand-holding-heart mr-2"></i> Data Bansos
            </a>

            {{-- STUNTING --}}
            <a href="{{ route('dashboard.stunting.index') }}"
               onclick="closeSidebar()"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.stunting') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-child mr-2"></i> Stunting
            </a>
        @endif

        {{-- MENU KHUSUS ADMIN --}}
        @if ($role === 'admin')
            <a href="{{ route('dashboard.berita.index') }}"
               onclick="closeSidebar()"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.berita.*') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-newspaper mr-2"></i> Berita
            </a>

            <a href="{{ route('dashboard.potensi.index') }}"
               onclick="closeSidebar()"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.potensi.*') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-seedling mr-2"></i> Potensi Desa
            </a>

            <a href="{{ route('dashboard.galeri-foto.index') }}"
               onclick="closeSidebar()"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.galeri-foto.*') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-images mr-2"></i> Galeri Foto
            </a>

            <a href="{{ route('dashboard.feedback.index') }}"
               onclick="closeSidebar()"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.feedback.*') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-comment-dots mr-2"></i> Feedback
            </a>
        @endif

    </nav>

    {{-- Logout --}}
    <div class="p-4 border-t border-white/10">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-sm font-semibold">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- JavaScript untuk Sidebar Toggle --}}
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.toggle('-translate-x-full');
        sidebar.classList.toggle('translate-x-0');
        overlay.classList.toggle('hidden');
    }

    function closeSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        overlay.classList.add('hidden');
    }
</script>