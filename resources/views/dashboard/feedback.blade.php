@extends('layouts.dashboard')

@section('title', 'Dashboard - Feedback Pengunjung')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-[#2C7961] mb-6">Feedback Pengunjung</h2>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        {{-- Toolbar: Search + Create --}}
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <form method="GET" action="{{ route('dashboard.feedback.index') }}" class="flex w-full max-w-lg items-center gap-2">
                <input
                    type="text"
                    name="q"
                    value="{{ $q }}"
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:border-[#2C7961] focus:outline-none"
                    placeholder="Cari nama, email, atau pesan..."
                />
                <button
                    type="submit"
                    class="rounded bg-[#2C7961] px-4 py-2 text-white hover:opacity-90"
                >Cari</button>
                @if($q)
                    <a href="{{ route('dashboard.feedback.index') }}" class="rounded border px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">Reset</a>
                @endif
            </form>

        </div>

        @if($feedback->count())
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded">
                    <thead>
                        <tr class="bg-gray-100 text-[#2C7961]">
                            <th class="py-2 px-4 border-b text-left">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama</th>
                            <th class="py-2 px-4 border-b text-left">Email</th>
                            <th class="py-2 px-4 border-b text-left">Pesan / Saran</th>
                            <th class="py-2 px-4 border-b text-left">Tanggal</th>
                            <th class="py-2 px-4 border-b text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedback as $i => $f)
                            <tr class="hover:bg-gray-50">
                                {{-- nomor urut mengikuti paginasi --}}
                                <td class="py-2 px-4 border-b">
                                    {{ $feedback->firstItem() + $i }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                    {{ $f->nama ?: '-' }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                    {{ $f->email ?: '-' }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                    {{ $f->pesan }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                    {{-- Prioritaskan kolom 'tanggal' dari DB, fallback ke created_at --}}
                                    @php
                                        $tgl = $f->tanggal ?? $f->created_at;
                                    @endphp
                                    {{ \Illuminate\Support\Carbon::parse($tgl)->format('d M Y') }}
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <div class="flex flex-wrap gap-2">
                                        
                                        <form action="{{ route('dashboard.feedback.destroy', $f) }}" method="POST"
                                              onsubmit="return confirm('Hapus feedback ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="rounded border px-3 py-1 text-sm text-red-700 hover:bg-gray-50">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $feedback->onEachSide(1)->links() }}
                </div>
            </div>
        @else
            <div class="text-gray-500 text-center py-8">
                Belum ada feedback dari pengunjung.
            </div>
        @endif
    </div>
</div>
@endsection
