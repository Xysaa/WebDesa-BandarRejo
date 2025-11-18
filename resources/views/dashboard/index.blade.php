@extends('layouts.dashboard')

@section('title', 'Dasbor Utama')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang, Admin Desa Bandar Rejo!</h2>
    
    {{-- Konfirmasi Perubahan Data (masih statis, nanti bisa dihubungkan ke tabel lain) --}}
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded shadow flex items-center justify-between mb-8">
        <div>
            <span class="font-semibold text-yellow-700">Konfirmasi:</span>
            <span class="text-yellow-700">Ada perubahan data dari Kepala Dusun. Mohon admin desa melakukan verifikasi sebelum data diubah.</span>
        </div>
        <button class="ml-4 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded font-semibold">Lihat & Konfirmasi</button>
    </div>

    {{-- Statistik Kependudukan --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-[#2C7961]">
                {{ number_format($totalPenduduk, 0, ',', '.') }}
            </div>
            <div class="text-gray-600 mt-2">Total Penduduk</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-[#2C7961]">
                {{ number_format($totalKk, 0, ',', '.') }}
            </div>
            <div class="text-gray-600 mt-2">Kepala Keluarga</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-[#2C7961]">
                {{ number_format($totalLaki, 0, ',', '.') }}
            </div>
            <div class="text-gray-600 mt-2">Laki-laki</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-[#2C7961]">
                {{ number_format($totalPerempuan, 0, ',', '.') }}
            </div>
            <div class="text-gray-600 mt-2">Perempuan</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        {{-- Berdasarkan Umur --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Umur</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Anak-anak (0-12): <span class="font-bold">{{ $umur['anak'] ?? 0 }}</span></li>
                <li>Remaja (13-17): <span class="font-bold">{{ $umur['remaja'] ?? 0 }}</span></li>
                <li>Dewasa (18-59): <span class="font-bold">{{ $umur['dewasa'] ?? 0 }}</span></li>
                <li>Lansia (60+): <span class="font-bold">{{ $umur['lansia'] ?? 0 }}</span></li>
            </ul>
        </div>

        {{-- Berdasarkan Dusun --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Dusun</h2>
            <ul class="text-gray-700 space-y-1">
                @forelse ($dusunStats as $d)
                    <li>Dusun {{ $d->dusun }}:
                        <span class="font-bold">{{ number_format($d->total, 0, ',', '.') }}</span>
                    </li>
                @empty
                    <li class="text-gray-500 italic">Belum ada data penduduk.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Berdasarkan Pendidikan --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Pendidikan</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Tidak Sekolah: <span class="font-bold">{{ $pendidikanRingkas['Tidak Sekolah'] ?? 0 }}</span></li>
                <li>SD: <span class="font-bold">{{ $pendidikanRingkas['SD'] ?? 0 }}</span></li>
                <li>SMP: <span class="font-bold">{{ $pendidikanRingkas['SMP'] ?? 0 }}</span></li>
                <li>SMA: <span class="font-bold">{{ $pendidikanRingkas['SMA'] ?? 0 }}</span></li>
                <li>Perguruan Tinggi: <span class="font-bold">{{ $pendidikanRingkas['Perguruan Tinggi'] ?? 0 }}</span></li>
            </ul>
        </div>

        {{-- Berdasarkan Pekerjaan (nanti bisa diimprove pakai relasi pekerjaans) --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Pekerjaan</h2>

            @if ($pekerjaanStats->isEmpty())
                <p class="text-gray-500 text-sm italic">Belum ada data pekerjaan.</p>
            @else
                <ul class="text-gray-700 space-y-1 max-h-60 overflow-y-auto pr-2">
                    @foreach ($pekerjaanStats as $pekerjaan)
                        <li class="flex justify-between">
                            <span>{{ $pekerjaan->nama_pekerjaan }}</span>
                            <span class="font-bold">
                                {{ number_format($pekerjaan->penduduks_count, 0, ',', '.') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>


        {{-- Berdasarkan Perkawinan --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Perkawinan</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Belum Kawin: <span class="font-bold">{{ $perkawinanRingkas['Belum Kawin'] ?? 0 }}</span></li>
                <li>Kawin: <span class="font-bold">{{ $perkawinanRingkas['Kawin'] ?? 0 }}</span></li>
                <li>Cerai: <span class="font-bold">{{ $perkawinanRingkas['Cerai'] ?? 0 }}</span></li>
            </ul>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        {{-- Berdasarkan Agama --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Berdasarkan Agama</h2>
            <ul class="text-gray-700 space-y-1">
                <li>Islam: <span class="font-bold">{{ $agama['Islam'] ?? 0 }}</span></li>
                <li>Kristen: <span class="font-bold">{{ $agama['Kristen'] ?? 0 }}</span></li>
                <li>Hindu: <span class="font-bold">{{ $agama['Hindu'] ?? 0 }}</span></li>
                <li>Buddha: <span class="font-bold">{{ $agama['Budha'] ?? 0 }}</span></li>
            </ul>
        </div>

        {{-- Data Stunting per Dusun (masih statis) --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-lg text-[#2C7961]">Data Stunting per Dusun</h2>
                @if ($latestStuntingYear)
                    <span class="text-xs text-gray-500">
                        Tahun {{ $latestStuntingYear }}
                    </span>
                @endif
            </div>

            @if ($stuntingPerDusun->isEmpty())
                <p class="text-gray-500 text-sm italic">Belum ada data stunting.</p>
            @else
                <ul class="text-gray-700 space-y-1">
                    @foreach ($stuntingPerDusun as $row)
                        <li>
                            {{ $row->nama_dusun }}:
                            <span class="font-bold">{{ $row->jumlah_anak_stunting }}</span> anak
                            @if ($row->keterangan)
                                <span class="text-xs text-gray-500">({{ $row->keterangan }})</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>

    {{-- Data Bansos (masih statis) --}}
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="font-semibold text-lg mb-4 text-[#2C7961]">Data Bansos</h2>

        @if ($bansosPrograms->isEmpty())
            <p class="text-gray-500 text-sm italic">Belum ada data bansos.</p>
        @else
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach ($bansosPrograms as $program)
                    <div class="bg-[#2C7961]/10 rounded p-4 text-center">
                        <div class="font-bold text-base md:text-lg text-[#2C7961]">
                            {{ $program->nama_program ?? $program->nama ?? 'Program' }}
                        </div>
                        <div class="text-gray-700 text-sm md:text-base">
                            {{ $program->jumlah_penerima ?? $program->jumlah ?? '-' }}
                            {{ $program->satuan ?? '' }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection
