<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Support\Facades\DB;

class InfografisController extends Controller
{
    public function index()
    {
        // --- Ringkasan utama ---
        $totalPenduduk   = Penduduk::count();
        $kepalaKeluarga  = $totalPenduduk / 4; // Asumsi 1 KK = 4 orang
        $lakiLaki        = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan       = Penduduk::where('jenis_kelamin', 'Perempuan')->count();

        // --- Kelompok umur (pakai kolom umur) ---
        $ageGroupsConfig = [
            '0-4'   => [0, 4],
            '5-9'   => [5, 9],
            '10-14' => [10, 14],
            '15-19' => [15, 19],
            '20-24' => [20, 24],
            '25-29' => [25, 29],
            '30-34' => [30, 34],
            '35-39' => [35, 39],
            '40-44' => [40, 44],
            '45-49' => [45, 49],
            '50-54' => [50, 54],
            '55-59' => [55, 59],
            '60-64' => [60, 64],
            '65-69' => [65, 69],
            '70-74' => [70, 74],
            '75-79' => [75, 79],
            '80-84' => [80, 84],
            '85+'   => [85, 200],
        ];

        $ageChart = [
            'labels' => array_keys($ageGroupsConfig),
            'male'   => [],
            'female' => [],
        ];

        foreach ($ageGroupsConfig as $label => [$min, $max]) {
            $maleCount = Penduduk::where('jenis_kelamin', 'Laki-laki')
                ->whereBetween('umur', [$min, $max])
                ->count();

            $femaleCount = Penduduk::where('jenis_kelamin', 'Perempuan')
                ->whereBetween('umur', [$min, $max])
                ->count();

            $ageChart['male'][]   = $maleCount;
            $ageChart['female'][] = $femaleCount;
        }

        // Ringkasan sederhana untuk teks deskripsi
        $ageSummary = [
            'male' => [
                'top_index' => null,
                'top_label' => null,
                'top_value' => null,
            ],
            'female' => [
                'top_index' => null,
                'top_label' => null,
                'top_value' => null,
            ],
        ];

        if (count($ageChart['male'])) {
            $maxMale   = max($ageChart['male']);
            $idxMale   = array_search($maxMale, $ageChart['male']);
            $ageSummary['male'] = [
                'top_index' => $idxMale,
                'top_label' => $ageChart['labels'][$idxMale] ?? null,
                'top_value' => $maxMale,
            ];
        }

        if (count($ageChart['female'])) {
            $maxFemale = max($ageChart['female']);
            $idxFemale = array_search($maxFemale, $ageChart['female']);
            $ageSummary['female'] = [
                'top_index' => $idxFemale,
                'top_label' => $ageChart['labels'][$idxFemale] ?? null,
                'top_value' => $maxFemale,
            ];
        }

        // --- Berdasarkan Dusun (Dusun 1–7) ---
        $dusunChart = Penduduk::select('dusun', DB::raw('COUNT(*) as total'))
            ->groupBy('dusun')
            ->orderBy('dusun')
            ->get()
            ->map(function ($row) {
                return [
                    'name'  => 'Dusun ' . $row->dusun,
                    'count' => $row->total,
                ];
            })
            ->values();

        // --- Berdasarkan Pendidikan ---
        $pendidikanCounts = Penduduk::select('pendidikan', DB::raw('COUNT(*) as total'))
            ->groupBy('pendidikan')
            ->orderBy('pendidikan')
            ->get();

        // --- Berdasarkan Pekerjaan (top 6) ---
        $topPekerjaan = Penduduk::join('pekerjaans', 'penduduks.pekerjaan_id', '=', 'pekerjaans.id')
            ->select('pekerjaans.nama_pekerjaan as nama', DB::raw('COUNT(*) as total'))
            ->groupBy('pekerjaans.nama_pekerjaan')
            ->orderByDesc('total')
            ->take(6)
            ->get();

        // --- Berdasarkan Agama ---
        $agamaCounts = Penduduk::select('agama', DB::raw('COUNT(*) as total'))
            ->groupBy('agama')
            ->orderBy('agama')
            ->get();

        // --- Berdasarkan Perkawinan ---
        $perkawinanCounts = Penduduk::select('perkawinan', DB::raw('COUNT(*) as total'))
            ->groupBy('perkawinan')
            ->orderBy('perkawinan')
            ->get();

        return view('infografis', compact(
            'totalPenduduk',
            'kepalaKeluarga',
            'lakiLaki',
            'perempuan',
            'ageChart',
            'ageSummary',
            'dusunChart',
            'pendidikanCounts',
            'topPekerjaan',
            'agamaCounts',
            'perkawinanCounts'
        ));
    }
}
