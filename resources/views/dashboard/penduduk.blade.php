@extends('layouts.dashboard')

@section('title', 'Data Kependudukan')

@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-6">Data Kependudukan Desa Bandar Rejo</h2>

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

{{-- Tombol tambah data --}}
<div class="mb-6">
    <button id="btnTambahPenduduk"
        class="bg-[#2C7961] hover:bg-[#256952] text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
        <i class="fas fa-plus mr-2"></i> Tambah Data Penduduk
    </button>
</div>

{{-- Form tambah/edit penduduk (hidden by default) --}}
<div id="formPenduduk" class="hidden max-w-4xl bg-white rounded-lg shadow p-6 mb-8">
    <h3 id="formTitle" class="text-xl font-bold text-[#2C7961] mb-4">Tambah Data Penduduk</h3>

    {{-- Error form global (front-end) --}}
    <p id="formError" class="text-sm text-red-600 mb-4 hidden"></p>

    <form id="pendudukForm" method="POST" action="{{ route('dashboard.penduduk.store') }}">
        @csrf
        <input type="hidden" id="formMode" value="create">
        <input type="hidden" id="pendudukId" value="">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-1">NIK</label>
                <input type="text" id="nik" name="nik"
                       value="{{ old('nik') }}"
                       class="w-full px-3 py-2 border rounded"
                       maxlength="16" required>
                <p id="nikError" class="text-xs text-red-500 mt-1 hidden"></p>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">No KK</label>
                <input type="text" id="no_kk" name="no_kk"
                       value="{{ old('no_kk') }}"
                       class="w-full px-3 py-2 border rounded"
                       maxlength="16" required>
                <p id="noKkError" class="text-xs text-red-500 mt-1 hidden"></p>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama"
                       value="{{ old('nama') }}"
                       class="w-full px-3 py-2 border rounded" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                        class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir"
                       value="{{ old('tgl_lahir') }}"
                       max="{{ $today }}"
                       class="w-full px-3 py-2 border rounded"
                       required onchange="hitungUmur()">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Umur</label>
                <input type="text" id="umur_display"
                       class="w-full px-3 py-2 border rounded bg-gray-100"
                       readonly>
            </div>

            <input type="hidden" id="umur" name="umur">

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Dusun</label>
                <select id="dusun" name="dusun" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Dusun</option>
                    @for($i = 1; $i <= 7; $i++)
                        <option value="{{ $i }}" {{ old('dusun') == $i ? 'selected' : '' }}>Dusun {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Pendidikan</label>
                <select id="pendidikan" name="pendidikan" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Pendidikan</option>
                    @foreach($pendidikanOptions as $opt)
                        <option value="{{ $opt }}" {{ old('pendidikan') === $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Pekerjaan</label>
                <select id="pekerjaan_id" name="pekerjaan_id" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Pekerjaan</option>
                    @foreach($pekerjaans as $pekerjaan)
                        <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id') == $pekerjaan->id ? 'selected' : '' }}>
                            {{ $pekerjaan->nama_pekerjaan }} ({{ $pekerjaan->bidang_pekerjaan }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Status Perkawinan</label>
                <select id="perkawinan" name="perkawinan" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Status</option>
                    @foreach($perkawinanOptions as $opt)
                        <option value="{{ $opt }}" {{ old('perkawinan') === $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Agama</label>
                <select id="agama" name="agama" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Pilih Agama</option>
                    @foreach($agamaOptions as $opt)
                        <option value="{{ $opt }}" {{ old('agama') === $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-semibold mb-1">Alamat</label>
                <input type="text" id="alamat" name="alamat"
                       value="{{ old('alamat') }}"
                       class="w-full px-3 py-2 border rounded" required>
            </div>
        </div>
        <div class="flex gap-2 mt-4">
            <button type="submit"
                    class="bg-[#2C7961] text-white px-4 py-2 rounded hover:bg-[#256952]">
                Simpan
            </button>
            <button type="button" onclick="batalEdit()"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                Batal
            </button>
        </div>
    </form>
</div>

{{-- Tabel data penduduk --}}
<div class="overflow-x-auto">
    <table id="pendudukTable" class="min-w-full bg-white rounded-lg shadow text-xs md:text-sm">
        <thead>
            <tr class="bg-[#2C7961] text-white">
                <th class="py-2 px-3">NIK</th>
                <th class="py-2 px-3">No KK</th>
                <th class="py-2 px-3">Nama</th>
                <th class="py-2 px-3">JK</th>
                <th class="py-2 px-3">Tgl Lahir</th>
                <th class="py-2 px-3">Umur</th>
                <th class="py-2 px-3">Dusun</th>
                <th class="py-2 px-3">Pendidikan</th>
                <th class="py-2 px-3">Pekerjaan</th>
                <th class="py-2 px-3">Perkawinan</th>
                <th class="py-2 px-3">Agama</th>
                <th class="py-2 px-3">Alamat</th>
                <th class="py-2 px-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penduduks as $penduduk)
                <tr class="border-b">
                    <td class="py-2 px-3">{{ $penduduk->nik }}</td>
                    <td class="py-2 px-3">{{ $penduduk->no_kk }}</td>
                    <td class="py-2 px-3">{{ $penduduk->nama }}</td>
                    <td class="py-2 px-3">{{ $penduduk->jenis_kelamin }}</td>
                    <td class="py-2 px-3">{{ $penduduk->tgl_lahir->format('d-m-Y') }}</td>
                    <td class="py-2 px-3">{{ $penduduk->umur }} th</td>
                    <td class="py-2 px-3">Dusun {{ $penduduk->dusun }}</td>
                    <td class="py-2 px-3">{{ $penduduk->pendidikan }}</td>
                    <td class="py-2 px-3">
                        {{ $penduduk->pekerjaan?->nama_pekerjaan }}
                    </td>
                    <td class="py-2 px-3">{{ $penduduk->perkawinan }}</td>
                    <td class="py-2 px-3">{{ $penduduk->agama }}</td>
                    <td class="py-2 px-3">{{ $penduduk->alamat }}</td>
                    <td class="py-2 px-3">
                        <div class="flex flex-col gap-1">
 
                            <button
                                type="button"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold"
                                onclick='editPenduduk(@json($penduduk))'>
                                <i class="fas fa-edit"></i>
                            </button>

                            <form action="{{ route('dashboard.penduduk.destroy', $penduduk) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="py-4 px-3 text-center text-gray-500">
                        Belum ada data penduduk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($penduduks->hasPages())
        <div class="mt-4">
            {{ $penduduks->links() }}
        </div>
    @endif
</div>

<script>
    const btnTambahPenduduk = document.getElementById('btnTambahPenduduk');
    const formPenduduk = document.getElementById('formPenduduk');
    const formTitle = document.getElementById('formTitle');
    const pendudukForm = document.getElementById('pendudukForm');
    const formMode = document.getElementById('formMode');
    const pendudukIdInput = document.getElementById('pendudukId');

    const nikInput = document.getElementById('nik');
    const noKkInput = document.getElementById('no_kk');
    const nikError = document.getElementById('nikError');
    const noKkError = document.getElementById('noKkError');
    const formError = document.getElementById('formError');

    btnTambahPenduduk.onclick = function() {
        setCreateMode();
        formPenduduk.classList.remove('hidden');
        window.scrollTo({ top: formPenduduk.offsetTop - 80, behavior: 'smooth' });
    };

    function clearErrors() {
        formError.classList.add('hidden');
        formError.textContent = '';

        nikError.classList.add('hidden');
        nikError.textContent = '';
        nikInput.classList.remove('border-red-500');

        noKkError.classList.add('hidden');
        noKkError.textContent = '';
        noKkInput.classList.remove('border-red-500');

        const requiredFields = pendudukForm.querySelectorAll('input[required], select[required]');
        requiredFields.forEach(el => el.classList.remove('border-red-500'));
    }

    // 👉 MODE TAMBAH (CREATE)
    function setCreateMode() {
        formMode.value = 'create';
        pendudukIdInput.value = '';
        formTitle.textContent = 'Tambah Data Penduduk';

        // ✅ ARAHKAN KE ROUTE STORE (POST)
        pendudukForm.action = "{{ route('dashboard.penduduk.store') }}";

        pendudukForm.reset();
        document.getElementById('umur').value = '';
        document.getElementById('umur_display').value = '';

        // hapus _method kalau ada (biar balik ke POST)
        const methodInput = pendudukForm.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }

        clearErrors();
    }

    // 👉 MODE EDIT
    function setEditMode(penduduk) {
        clearErrors();

        formMode.value = 'edit';
        pendudukIdInput.value = penduduk.id;
        formTitle.textContent = 'Edit Data Penduduk';

        // ✅ PAKAI NAMED ROUTE UNTUK UPDATE
        pendudukForm.action = "{{ route('dashboard.penduduk.update', ['penduduk' => '__ID__']) }}"
            .replace('__ID__', penduduk.id);

        // spoof method PUT
        let methodInput = pendudukForm.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            pendudukForm.appendChild(methodInput);
        }
        methodInput.value = 'PUT';

        // --- handle tgl_lahir supaya cocok dengan input type="date" ---
        let tgl = penduduk.tgl_lahir;

        if (tgl) {
            // kalau bentuknya { date: "2024-01-01 00:00:00.000000", ... }
            if (typeof tgl === 'object' && tgl.date) {
                tgl = tgl.date.substring(0, 10); // ambil "YYYY-MM-DD"
            }
            // kalau string panjang "2024-01-01 00:00:00"
            if (typeof tgl === 'string' && tgl.length > 10) {
                tgl = tgl.substring(0, 10);
            }
        } else {
            tgl = '';
        }

        // set nilai field
        document.getElementById('nik').value = penduduk.nik ?? '';
        document.getElementById('no_kk').value = penduduk.no_kk ?? '';
        document.getElementById('nama').value = penduduk.nama ?? '';
        document.getElementById('jenis_kelamin').value = penduduk.jenis_kelamin ?? '';
        document.getElementById('tgl_lahir').value = tgl;
        document.getElementById('dusun').value = penduduk.dusun ?? '';
        document.getElementById('pendidikan').value = penduduk.pendidikan ?? '';
        document.getElementById('pekerjaan_id').value = penduduk.pekerjaan_id ?? '';
        document.getElementById('perkawinan').value = penduduk.perkawinan ?? '';
        document.getElementById('agama').value = penduduk.agama ?? '';
        document.getElementById('alamat').value = penduduk.alamat ?? '';

        // hitung umur untuk display
        hitungUmur();

        formPenduduk.classList.remove('hidden');
        window.scrollTo({ top: formPenduduk.offsetTop - 80, behavior: 'smooth' });
    }

    function batalEdit() {
        formPenduduk.classList.add('hidden');
        setCreateMode();
    }

    // Hitung umur otomatis (front-end)
    function hitungUmur() {
        const tgl = document.getElementById('tgl_lahir').value;
        const umurHidden = document.getElementById('umur');
        const umurDisplay = document.getElementById('umur_display');

        if (!tgl) {
            umurHidden.value = '';
            umurDisplay.value = '';
            return;
        }
        const today = new Date();
        const birth = new Date(tgl);
        let umur = today.getFullYear() - birth.getFullYear();
        const m = today.getMonth() - birth.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) {
            umur--;
        }
        if (umur < 0) umur = 0;

        umurHidden.value = umur;
        umurDisplay.value = umur + ' tahun';
    }

    // Validasi NIK dan No KK (hanya angka & 16 digit)
    function validateNik() {
        let value = nikInput.value.replace(/\D/g, '');
        nikInput.value = value;

        let message = '';
        if (value.length === 0) {
            message = 'NIK wajib diisi.';
        } else if (value.length !== 16) {
            message = 'NIK harus 16 digit.';
        }

        if (message) {
            nikError.textContent = message;
            nikError.classList.remove('hidden');
            nikInput.classList.add('border-red-500');
            return false;
        } else {
            nikError.textContent = '';
            nikError.classList.add('hidden');
            nikInput.classList.remove('border-red-500');
            return true;
        }
    }

    function validateNoKk() {
        let value = noKkInput.value.replace(/\D/g, '');
        noKkInput.value = value;

        let message = '';
        if (value.length === 0) {
            message = 'No KK wajib diisi.';
        } else if (value.length !== 16) {
            message = 'No KK harus 16 digit.';
        }

        if (message) {
            noKkError.textContent = message;
            noKkError.classList.remove('hidden');
            noKkInput.classList.add('border-red-500');
            return false;
        } else {
            noKkError.textContent = '';
            noKkError.classList.add('hidden');
            noKkInput.classList.remove('border-red-500');
            return true;
        }
    }

    nikInput.addEventListener('input', validateNik);
    nikInput.addEventListener('blur', validateNik);
    noKkInput.addEventListener('input', validateNoKk);
    noKkInput.addEventListener('blur', validateNoKk);

    // Validasi semua field sebelum submit
    pendudukForm.addEventListener('submit', function (e) {
        clearErrors();

        let isValid = true;

        const requiredFields = pendudukForm.querySelectorAll('input[required], select[required]');
        requiredFields.forEach(el => {
            const value = el.value;
            if (!value || value === '') {
                isValid = false;
                el.classList.add('border-red-500');
            }
        });

        const nikValid = validateNik();
        const noKkValid = validateNoKk();

        if (!isValid || !nikValid || !noKkValid) {
            e.preventDefault();
            formError.textContent = 'Harap lengkapi semua field wajib dan pastikan NIK serta No KK berisi 16 digit angka.';
            formError.classList.remove('hidden');
            window.scrollTo({ top: formPenduduk.offsetTop - 80, behavior: 'smooth' });
        }
    });

    // untuk dipanggil dari tombol edit di table
    window.editPenduduk = function(penduduk) {
        setEditMode(penduduk);
    };
</script>

@endsection
