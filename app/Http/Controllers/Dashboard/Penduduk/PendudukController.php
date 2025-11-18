<?php

namespace App\Http\Controllers\Dashboard\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduks = Penduduk::with('pekerjaan')
            ->orderBy('nama')
            ->paginate(10);

        $pekerjaans = Pekerjaan::orderBy('nama_pekerjaan')->get();

        $today = now()->toDateString();

        // untuk select option di blade
        $pendidikanOptions = [
            'Tidak / Belum Sekolah',
            'Belum Tamat SD Sederajat',
            'Tamat SD Sederajat',
            'SLTP Sederajat',
            'SLTA Sederajat',
            'Diploma I',
            'Diploma III',
            'Diploma IV',
            'Strata 1',
        ];

        $perkawinanOptions = [
            'Belum Kawin',
            'Kawin',
            'Cerai Mati',
            'Kawin Tercatat',
            'Cerai Hidup',
            'Kawin Tidak Tercatat',
        ];

        $agamaOptions = [
            'Islam',
            'Katolik',
            'Hindu',
            'Budha',
            'Konghucu',
            'Kristen',
            'Kepercayaan Lainnya',
        ];

        return view('dashboard.penduduk', compact(
            'penduduks',
            'pekerjaans',
            'today',
            'pendidikanOptions',
            'perkawinanOptions',
            'agamaOptions'
        ));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $validated['umur'] = $this->hitungUmur($validated['tgl_lahir']);

        Penduduk::create($validated);

        return redirect()
            ->route('dashboard.penduduk')
            ->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $validated = $this->validateData($request, $penduduk->id);

        $validated['umur'] = $this->hitungUmur($validated['tgl_lahir']);

        $penduduk->update($validated);

        return redirect()
            ->route('dashboard.penduduk')
            ->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()
            ->route('dashboard.penduduk')
            ->with('success', 'Data penduduk berhasil dihapus.');
    }

    protected function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'nik' => [
                'required',
                'digits:16',
                'numeric',
                Rule::unique('penduduks', 'nik')->ignore($ignoreId),
            ],
            'no_kk' => [
                'required',
                'digits:16',
                'numeric',
            ],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'tgl_lahir' => ['required', 'date', 'before_or_equal:today'],
            'dusun' => ['required', 'integer', 'between:1,7'],
            'pendidikan' => [
                'required',
                Rule::in([
                    'Tidak / Belum Sekolah',
                    'Belum Tamat SD Sederajat',
                    'Tamat SD Sederajat',
                    'SLTP Sederajat',
                    'SLTA Sederajat',
                    'Diploma I',
                    'Diploma III',
                    'Diploma IV',
                    'Strata 1',
                ]),
            ],
            'pekerjaan_id' => [
                'required',
                'exists:pekerjaans,id',
            ],
            'perkawinan' => [
                'required',
                Rule::in([
                    'Belum Kawin',
                    'Kawin',
                    'Cerai Mati',
                    'Kawin Tercatat',
                    'Cerai Hidup',
                    'Kawin Tidak Tercatat',
                ]),
            ],
            'agama' => [
                'required',
                Rule::in([
                    'Islam',
                    'Katolik',
                    'Hindu',
                    'Budha',
                    'Konghucu',
                    'Kristen',
                    'Kepercayaan Lainnya',
                ]),
            ],
            'alamat' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function hitungUmur(string $tglLahir): int
    {
        return Carbon::parse($tglLahir)->age;
    }
}
