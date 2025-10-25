@props([
    'alamat' => "Bandar Rejo, Kec. Natar,
Kabupaten Lampung Selatan,
Lampung 35362, Indonesia

Bandar Rejo, Kecamatan Natar,
Kabupaten Lampung Selatan
Provinsi Lampung 35362",
    'telp' => '000000000000',
    'email' => 'bandarrejo.com',
    'tahun' => now()->year,
])

<footer class="w-full bg-[#2C7961] text-white font-poppins">
    <div class="max-w-7xl mx-auto px-4 py-8">
        {{-- Kotak border dashed seperti contoh --}}
        <div class="rounded-md border border-dashed border-white/40 p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                {{-- Kolom 1: Logo + Alamat --}}
                <div class="flex items-start gap-3">
                    <img src="{{ asset('images/Logo.png') }}" alt="Logo Desa"
                         class="h-16 w-16 object-contain rounded-full">
                    <div class="text-sm leading-relaxed">
                        <div class="font-semibold mb-1">Pemerintah Desa Bandar Rejo</div>
                        <p class="whitespace-pre-line text-white/90">
                            {{ $alamat }}
                        </p>
                    </div>
                </div>

                {{-- Kolom 2: Hubungi Kami --}}
                <div>
                    <h4 class="font-semibold mb-3">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">
                            {{-- Ikon telepon (Heroicons) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h1.28a1 1 0 01.95.684l1.13 3.39a1 1 0 01-.27 1.06l-1.2 1.2a16 16 0 006.36 6.36l1.2-1.2a1 1 0 011.06-.27l3.39 1.13a1 1 0 01.684.95V19a2 2 0 01-2 2h-1C9.82 21 3 14.18 3 6V5z" />
                            </svg>
                            <span>{{ $telp }}</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="https://{{ $email }}" class="hover:underline">{{ $email }}</a>
                        </li>
                    </ul>
                </div>

                {{-- Kolom 3: Nomor Telepon Penting --}}
                <div>
                    <h4 class="font-semibold mb-3">Nomor Telepon Penting</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:underline">Babinkamtibmas</a></li>
                        <li><a href="#" class="hover:underline">Babinsa</a></li>
                    </ul>
                </div>

                {{-- Kolom 4: Jelajahi --}}
                <div>
                    <h4 class="font-semibold mb-3">Jelajahi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:underline">Website Kemendesa</a></li>
                        <li><a href="#" class="hover:underline">Website Kemendagri</a></li>
                        <li><a href="#" class="hover:underline">Cek DPT Online</a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="mt-4 text-center text-xs text-white/90">
            © {{ $tahun }} Powered by Kapita Selekta RD
        </div>
    </div>
</footer>
