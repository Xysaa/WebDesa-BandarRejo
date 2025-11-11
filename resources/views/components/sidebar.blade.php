<aside class="w-64 bg-[#2C7961] text-white min-h-screen flex flex-col shadow-lg">
    <div class="p-6 border-b border-white/10 text-center">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo Desa" class="h-12 w-12 object-contain rounded-full mx-auto mb-2 bg-white p-1">
        <div class="font-bold text-xl mb-1">Desa Bandar Rejo</div>
        <div class="text-sm text-white/70">Dasbor Admin</div>
    </div>
    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('dashboard.index') }}" class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition duration-200 {{ request()->routeIs('dashboard.index') ? 'bg-[#256952] font-semibold' : '' }}">
            <i class="fas fa-home mr-2"></i> Dashboard
        </a>
        <a href="{{ route('dashboard.penduduk') }}" class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition duration-200 {{ request()->routeIs('dashboard.penduduk') ? 'bg-[#256952] font-semibold' : '' }}">
            <i class="fas fa-users mr-2"></i> Data Kependudukan
        </a>
        <a href="{{ route('dashboard.stunting') }}" class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition duration-200 {{ request()->routeIs('dashboard.stunting') ? 'bg-[#256952] font-semibold' : '' }}">
            <i class="fas fa-child mr-2"></i> Data Stunting
        </a>
        <a href="{{ route('dashboard.bansos') }}" class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition duration-200 {{ request()->routeIs('dashboard.bansos') ? 'bg-[#256952] font-semibold' : '' }}">
            <i class="fas fa-hand-holding-usd mr-2"></i> Data Bansos
        </a>
        <a href="{{ route('dashboard.berita') }}" class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition duration-200 {{ request()->routeIs('dashboard.berita') ? 'bg-[#256952] font-semibold' : '' }}">
            <i class="fas fa-newspaper mr-2"></i> Berita Desa
        </a>
        <a href="{{ route('dashboard.galeri') }}" class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition duration-200 {{ request()->routeIs('dashboard.galeri') ? 'bg-[#256952] font-semibold' : '' }}">
            <i class="fas fa-images mr-2"></i> Galeri Foto
        </a>
        <a href="{{ route('dashboard.potensi.index') }}" class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition duration-200 {{ request()->routeIs('dashboard.potensi') ? 'bg-[#256952] font-semibold' : '' }}">
            <i class="fas fa-seedling mr-2"></i> Potensi Desa
        </a>
        <a href="{{ route('dashboard.feedback') }}" class="block px-4 py-2 rounded-lg hover:bg-[#256952] transition duration-200 {{ request()->routeIs('dashboard.feedback') ? 'bg-[#256952] font-semibold' : '' }}">
            <i class="fas fa-comments mr-2"></i> Feedback
        </a>
    </nav>
    <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-white/10">
        @csrf
        <button type="submit" class="w-full bg-white text-[#2C7961] font-semibold py-2 rounded-lg hover:bg-gray-200 transition duration-200">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </button>
    </form>
</aside>
