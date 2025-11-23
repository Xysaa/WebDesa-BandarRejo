<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Pekerjaan;
use App\Models\DataStunting;
use App\Models\Bansos; // sesuaikan kalau nama model beda

class DashboardController extends Controller
{
    public function index()
    {
        // --- Statistik utama ---
        $totalPenduduk   = Penduduk::count();
        $totalKk         = $totalPenduduk/4; // Asumsi 1 KK = 4 orang
        $totalLaki       = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan  = Penduduk::where('jenis_kelamin', 'Perempuan')->count();

        // --- Berdasarkan umur ---
        $umur = [
            'anak'   => Penduduk::whereBetween('umur', [0, 12])->count(),
            'remaja' => Penduduk::whereBetween('umur', [13, 17])->count(),
            'dewasa' => Penduduk::whereBetween('umur', [18, 59])->count(),
            'lansia' => Penduduk::where('umur', '>=', 60)->count(),
        ];

        // --- Berdasarkan dusun (1–7) ---
        $dusunStats = Penduduk::selectRaw('dusun, COUNT(*) as total')
            ->groupBy('dusun')
            ->orderBy('dusun')
            ->get();

        // --- Berdasarkan pendidikan (detail) ---
        $pendidikanEnums = [
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

        $pendidikanDetail = [];
        foreach ($pendidikanEnums as $label) {
            $pendidikanDetail[$label] = Penduduk::where('pendidikan', $label)->count();
        }

        // Ringkas sesuai tampilan di Blade
        $pendidikanRingkas = [
            'Tidak Sekolah'      => $pendidikanDetail['Tidak / Belum Sekolah'] ?? 0,
            'SD'                 => ($pendidikanDetail['Belum Tamat SD Sederajat'] ?? 0)
                                    + ($pendidikanDetail['Tamat SD Sederajat'] ?? 0),
            'SMP'                => $pendidikanDetail['SLTP Sederajat'] ?? 0,
            'SMA'                => $pendidikanDetail['SLTA Sederajat'] ?? 0,
            'Perguruan Tinggi'   => ($pendidikanDetail['Diploma I'] ?? 0)
                                    + ($pendidikanDetail['Diploma III'] ?? 0)
                                    + ($pendidikanDetail['Diploma IV'] ?? 0)
                                    + ($pendidikanDetail['Strata 1'] ?? 0),
        ];

        // --- Berdasarkan perkawinan ---
        $perkawinanEnums = [
            'Belum Kawin',
            'Kawin',
            'Cerai Mati',
            'Kawin Tercatat',
            'Cerai Hidup',
            'Kawin Tidak Tercatat',
        ];

        $perkawinanDetail = [];
        foreach ($perkawinanEnums as $label) {
            $perkawinanDetail[$label] = Penduduk::where('perkawinan', $label)->count();
        }

        $perkawinanRingkas = [
            'Belum Kawin' => $perkawinanDetail['Belum Kawin'] ?? 0,
            'Kawin'       => ($perkawinanDetail['Kawin'] ?? 0)
                             + ($perkawinanDetail['Kawin Tercatat'] ?? 0)
                             + ($perkawinanDetail['Kawin Tidak Tercatat'] ?? 0),
            'Cerai'       => ($perkawinanDetail['Cerai Hidup'] ?? 0)
                             + ($perkawinanDetail['Cerai Mati'] ?? 0),
        ];

        // --- Berdasarkan agama ---
        $agamaEnums = [
            'Islam',
            'Katolik',
            'Hindu',
            'Budha',
            'Konghucu',
            'Kristen',
            'Kepercayaan Lainnya',
        ];

        $agama = [];
        foreach ($agamaEnums as $label) {
            $agama[$label] = Penduduk::where('agama', $label)->count();
        }

        // --- Statistik pekerjaan (dari tabel pekerjaan + relasi penduduk) ---
        // pastikan di model Pekerjaan ada ->penduduks()
        $pekerjaanStats = Pekerjaan::select('id', 'nama_pekerjaan')
            ->withCount('penduduks')
            ->orderByDesc('penduduks_count')
            ->get();

        // --- Data stunting per dusun (gunakan tahun terbaru) ---
        $latestStuntingYear = DataStunting::max('tahun');
        $stuntingPerDusun = DataStunting::query()
            ->when($latestStuntingYear, function ($q) use ($latestStuntingYear) {
                $q->where('tahun', $latestStuntingYear);
            })
            ->orderBy('nama_dusun')
            ->get();

        // --- Data Bansos (semua program) ---
        // Asumsi: tabel bansos punya kolom: nama_program, jumlah_penerima, satuan
        // kalau beda, sesuaikan di controller & blade
        $bansosPrograms = Bansos::orderBy('jenis_bansos')->get();

        return view('dashboard.index', [
            'totalPenduduk'      => $totalPenduduk,
            'totalKk'            => $totalKk,
            'totalLaki'          => $totalLaki,
            'totalPerempuan'     => $totalPerempuan,
            'umur'               => $umur,
            'dusunStats'         => $dusunStats,
            'pendidikanRingkas'  => $pendidikanRingkas,
            'perkawinanRingkas'  => $perkawinanRingkas,
            'agama'              => $agama,
            'pekerjaanStats'     => $pekerjaanStats,
            'stuntingPerDusun'   => $stuntingPerDusun,
            'latestStuntingYear' => $latestStuntingYear,
            'bansosPrograms'     => $bansosPrograms,
        ]);
    }
}
