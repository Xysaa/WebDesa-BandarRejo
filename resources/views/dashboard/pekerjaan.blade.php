@extends('layouts.dashboard')

@section('title', 'Data Pekerjaan')

@section('content')

@php
    $bidangOptions = [
        'Pertanian & Perkebunan',
        'Perikanan & Kelautan',
        'Perdagangan',
        'Jasa',
        'Pendidikan',
        'Kesehatan',
        'Industri & Manufaktur',
        'Konstruksi',
        'Transportasi & Logistik',
        'Pemerintahan & Administrasi',
        'Teknologi Informasi',
    ];
@endphp

<h2 class="text-3xl font-bold text-gray-800 mb-6">Data Pekerjaan Penduduk</h2>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
        <span class="block sm:inline">{{ $errors->first() }}</span>
    </div>
@endif

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Daftar Pekerjaan</h3>
        <button
            type="button"
            onclick="openCreatePekerjaanModal()"
            class="inline-flex items-center px-4 py-2 bg-[#2C7961] text-white text-sm font-semibold rounded hover:bg-[#256952] transition"
        >
            <i class="fas fa-plus mr-2"></i> Tambah Pekerjaan
        </button>
    </div>

    @if($pekerjaans->count())
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700">
                        <th class="px-4 py-2 border-b">#</th>
                        <th class="px-4 py-2 border-b">Nama Pekerjaan</th>
                        <th class="px-4 py-2 border-b">Bidang Pekerjaan</th>
                        <th class="px-4 py-2 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pekerjaans as $index => $pekerjaan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b align-top">
                                {{ $pekerjaans->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-2 border-b align-top">
                                <div class="font-semibold text-gray-800">
                                    {{ $pekerjaan->nama_pekerjaan }}
                                </div>
                            </td>
                            <td class="px-4 py-2 border-b align-top">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-gray-100 text-xs font-medium text-gray-700">
                                    {{ $pekerjaan->bidang_pekerjaan }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border-b align-top text-center">
                                <div class="inline-flex gap-2">
                                    <button
                                        type="button"
                                        onclick="openEditPekerjaanModal({{ $pekerjaan->id }})"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded bg-blue-500 text-white hover:bg-blue-600 transition"
                                    >
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </button>

                                    <form action="{{ route('dashboard.pekerjaan.destroy', $pekerjaan) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus pekerjaan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded bg-red-500 text-white hover:bg-red-600 transition">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($pekerjaans->hasPages())
            <div class="mt-4">
                {{ $pekerjaans->links() }}
            </div>
        @endif
    @else
        <p class="text-gray-600 mt-2">Belum ada data pekerjaan.</p>
    @endif
</div>

{{-- MODAL TAMBAH PEKERJAAN --}}
<div id="modal-create-pekerjaan"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4">
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Tambah Pekerjaan</h3>
            <button type="button" onclick="closeCreatePekerjaanModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="px-6 py-4">
            <form action="{{ route('dashboard.pekerjaan.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="nama_pekerjaan" class="block text-gray-700 font-semibold mb-2">
                        Nama Pekerjaan <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama_pekerjaan"
                        name="nama_pekerjaan"
                        value="{{ old('nama_pekerjaan') }}"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#2C7961]"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="bidang_pekerjaan" class="block text-gray-700 font-semibold mb-2">
                        Bidang Pekerjaan <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="bidang_pekerjaan"
                        name="bidang_pekerjaan"
                        class="w-full px-4 py-2 border rounded bg-white focus:outline-none focus:ring-2 focus:ring-[#2C7961]"
                        required
                    >
                        <option value="" disabled {{ old('bidang_pekerjaan') ? '' : 'selected' }}>
                            Pilih bidang pekerjaan
                        </option>
                        @foreach($bidangOptions as $opt)
                            <option value="{{ $opt }}" {{ old('bidang_pekerjaan') === $opt ? 'selected' : '' }}>
                                {{ $opt }}
                            </option>
                        @endforeach
                        <option value="Lainnya" {{ old('bidang_pekerjaan') === 'Lainnya' ? 'selected' : '' }}>
                            Lainnya
                        </option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button"
                            onclick="closeCreatePekerjaanModal()"
                            class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-sm font-semibold transition">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-6 py-2 rounded bg-[#2C7961] hover:bg-[#256952] text-white text-sm font-semibold transition">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT PEKERJAAN (SATU PER DATA) --}}
@foreach($pekerjaans as $pekerjaan)
    @php
        $currentBidang = old('bidang_pekerjaan', $pekerjaan->bidang_pekerjaan);
    @endphp

    <div id="modal-edit-pekerjaan-{{ $pekerjaan->id }}"
         class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800">Edit Pekerjaan</h3>
                <button type="button" onclick="closeEditPekerjaanModal({{ $pekerjaan->id }})" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="px-6 py-4">
                <form action="{{ route('dashboard.pekerjaan.update', $pekerjaan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Nama Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama_pekerjaan"
                            value="{{ old('nama_pekerjaan', $pekerjaan->nama_pekerjaan) }}"
                            class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#2C7961]"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Bidang Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="bidang_pekerjaan"
                            class="w-full px-4 py-2 border rounded bg-white focus:outline-none focus:ring-2 focus:ring-[#2C7961]"
                            required
                        >
                            <option value="" disabled>Pilih bidang pekerjaan</option>
                            @foreach($bidangOptions as $opt)
                                <option value="{{ $opt }}" {{ $currentBidang === $opt ? 'selected' : '' }}>
                                    {{ $opt }}
                                </option>
                            @endforeach
                            <option value="Lainnya" {{ (!in_array($currentBidang, $bidangOptions) && $currentBidang) || $currentBidang === 'Lainnya' ? 'selected' : '' }}>
                                Lainnya
                            </option>
                        </select>

                        @if(!in_array($currentBidang, $bidangOptions) && $currentBidang && $currentBidang !== 'Lainnya')
                            <p class="mt-1 text-xs text-gray-500">
                                Nilai bidang yang tersimpan saat ini: <span class="font-semibold">"{{ $currentBidang }}"</span>.
                            </p>
                        @endif
                    </div>

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button"
                                onclick="closeEditPekerjaanModal({{ $pekerjaan->id }})"
                                class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-sm font-semibold transition">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-6 py-2 rounded bg-[#2C7961] hover:bg-[#256952] text-white text-sm font-semibold transition">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

{{-- SCRIPT MODAL --}}
<script>
    function openCreatePekerjaanModal() {
        const modal = document.getElementById('modal-create-pekerjaan');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeCreatePekerjaanModal() {
        const modal = document.getElementById('modal-create-pekerjaan');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function openEditPekerjaanModal(id) {
        const modal = document.getElementById('modal-edit-pekerjaan-' + id);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeEditPekerjaanModal(id) {
        const modal = document.getElementById('modal-edit-pekerjaan-' + id);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    // Optional: close modal when clicking outside content
    document.addEventListener('click', function (event) {
        const createModal = document.getElementById('modal-create-pekerjaan');
        if (createModal && !createModal.classList.contains('hidden')) {
            const dialog = createModal.querySelector('div.bg-white');
            if (dialog && !dialog.contains(event.target) && !event.target.closest('[onclick*="openCreatePekerjaanModal"]')) {
                closeCreatePekerjaanModal();
            }
        }

        @foreach($pekerjaans as $pekerjaan)
        (function(id) {
            const modal = document.getElementById('modal-edit-pekerjaan-' + id);
            if (modal && !modal.classList.contains('hidden')) {
                const dialog = modal.querySelector('div.bg-white');
                if (dialog && !dialog.contains(event.target) && !event.target.closest('[onclick*="openEditPekerjaanModal(' + id + ')"]')) {
                    closeEditPekerjaanModal(id);
                }
            }
        })({{ $pekerjaan->id }});
        @endforeach
    });
</script>

@endsection
