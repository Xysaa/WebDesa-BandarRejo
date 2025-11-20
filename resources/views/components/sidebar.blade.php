@php
    $user = auth()->user();
    $role = $user->role ?? null;

    $isPendudukOpen =
        request()->routeIs('dashboard.penduduk*') ||
        request()->routeIs('dashboard.pekerjaan.*') ||
        false;
@endphp

<aside class="w-64 bg-[#2C7961] text-white min-h-screen flex flex-col shadow-lg">
    <div class="p-6 border-b border-white/10 text-center">
        <img src="{{ asset('images/Logo.png') }}" class="h-12 w-12 rounded-full bg-white p-1 mx-auto mb-2">
        <div class="font-bold text-xl">Desa Bandarejo</div>
        <div class="text-sm text-white/70">Dasbor {{ $role === 'kepala_dusun' ? 'Kepala Dusun' : 'Admin' }}</div>
    </div>

    <nav class="flex-1 p-4 space-y-2">

        {{-- MENU KHUSUS ADMIN --}}
        @if ($role === 'admin')
            <a href="{{ route('dashboard.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.index') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
        @endif

        {{-- MENU ADMIN + KADUS --}}
        @if (in_array($role, ['admin', 'kepala_dusun']))

            {{-- DROPDOWN DATA PENDUDUK --}}
            <div x-data="{ open: {{ $isPendudukOpen ? 'true' : 'false' }} }" class="space-y-1">

                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-2 rounded-lg hover:bg-[#256952] transition
                           {{ $isPendudukOpen ? 'bg-[#256952] font-semibold' : '' }}">
                    <span><i class="fas fa-users mr-2"></i> Data Penduduk</span>
                    <i class="fas fa-chevron-down text-sm transition-transform"
                       :class="{ 'rotate-180': open }"></i>
                </button>

                <div x-show="open" x-collapse class="pl-6 space-y-1">

                    <a href="{{ route('dashboard.penduduk') }}"
                       class="block px-3 py-1.5 rounded hover:bg-[#256952]/50 transition
                              {{ request()->routeIs('dashboard.penduduk') ? 'bg-[#256952]/50 font-semibold' : '' }}">
                        Ringkasan
                    </a>

                    <a href="{{ route('dashboard.pekerjaan.index') }}"
                       class="block px-3 py-1.5 rounded hover:bg-[#256952]/50 transition
                              {{ request()->routeIs('dashboard.pekerjaan.*') ? 'bg-[#256952]/50 font-semibold' : '' }}">
                        Pekerjaan
                    </a>
                </div>
            </div>

            {{-- BANSOS --}}
            <a href="{{ route('dashboard.bansos.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.bansos.*') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-hand-holding-heart mr-2"></i> Data Bansos
            </a>

            {{-- STUNTING --}}
            <a href="{{ route('dashboard.stunting.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.stunting') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-child mr-2"></i> Stunting
            </a>
        @endif

        {{-- MENU KHUSUS ADMIN --}}
        @if ($role === 'admin')
            <a href="{{ route('dashboard.berita.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.berita.*') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-newspaper mr-2"></i> Berita
            </a>

            <a href="{{ route('dashboard.potensi.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.potensi.*') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-seedling mr-2"></i> Potensi Desa
            </a>

            <a href="{{ route('dashboard.galeri-foto.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition
                      {{ request()->routeIs('dashboard.galeri-foto.*') ? 'bg-[#256952] font-semibold' : '' }}">
                <i class="fas fa-images mr-2"></i> Galeri Foto
            </a>

            <a href="{{ route('dashboard.feedback.index') }}"
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

{{-- AlpineJS (jika belum ada) --}}
<script src="//unpkg.com/alpinejs" defer></script>