@extends('layouts.dashboard')

@section('title', 'Dashboard - Feedback Pengunjung')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-[#2C7961] mb-6">Feedback Pengunjung</h2>
    <div class="bg-white rounded-lg shadow p-6">
        @php
            // Data dummy feedback, bisa diganti dengan data dari database jika backend sudah siap
            $feedbacks = collect([
                (object)[
                    'nama' => 'Budi',
                    'email' => 'budi@gmail.com',
                    'pesan' => 'Website sangat membantu informasi desa.',
                    'created_at' => \Carbon\Carbon::parse('2024-06-01 13:22')
                ],
                (object)[
                    'nama' => 'Siti',
                    'email' => '',
                    'pesan' => 'Tampilan sudah bagus, semoga update data rutin.',
                    'created_at' => \Carbon\Carbon::parse('2024-06-03 09:10')
                ],
                (object)[
                    'nama' => '',
                    'email' => '',
                    'pesan' => 'Mohon tambahkan info UMKM desa.',
                    'created_at' => \Carbon\Carbon::parse('2024-06-04 18:05')
                ],
            ]);
        @endphp

        @if($feedbacks->count())
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded">
                    <thead>
                        <tr class="bg-gray-100 text-[#2C7961]">
                            <th class="py-2 px-4 border-b text-left">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama</th>
                            <th class="py-2 px-4 border-b text-left">Email</th>
                            <th class="py-2 px-4 border-b text-left">Pesan / Saran</th>
                            <th class="py-2 px-4 border-b text-left">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $i => $f)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b">{{ $i + 1 }}</td>
                                <td class="py-2 px-4 border-b">{{ $f->nama ?: '-' }}</td>
                                <td class="py-2 px-4 border-b">{{ $f->email ?: '-' }}</td>
                                <td class="py-2 px-4 border-b">{{ $f->pesan }}</td>
                                <td class="py-2 px-4 border-b">{{ $f->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-gray-500 text-center py-8">
                Belum ada feedback dari pengunjung.
            </div>
        @endif
    </div>
</div>
@endsection
