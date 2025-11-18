<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pekerjaan; // pastikan modelnya ada
// kalau belum ada modelnya:
// php artisan make:model Pekerjaan

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_pekerjaan'   => 'Petani',
                'bidang_pekerjaan' => 'Pertanian',
            ],
            [
                'nama_pekerjaan'   => 'Buruh Tani',
                'bidang_pekerjaan' => 'Pertanian',
            ],
            [
                'nama_pekerjaan'   => 'Pedagang',
                'bidang_pekerjaan' => 'Perdagangan',
            ],
            [
                'nama_pekerjaan'   => 'Pegawai Negeri Sipil (PNS)',
                'bidang_pekerjaan' => 'Pemerintahan',
            ],
            [
                'nama_pekerjaan'   => 'Guru',
                'bidang_pekerjaan' => 'Pendidikan',
            ],
            [
                'nama_pekerjaan'   => 'Tenaga Kesehatan',
                'bidang_pekerjaan' => 'Kesehatan',
            ],
            [
                'nama_pekerjaan'   => 'Karyawan Swasta',
                'bidang_pekerjaan' => 'Jasa/Perkantoran',
            ],
            [
                'nama_pekerjaan'   => 'Wirausaha',
                'bidang_pekerjaan' => 'Usaha/Perdagangan',
            ],
            [
                'nama_pekerjaan'   => 'Sopir/Driver',
                'bidang_pekerjaan' => 'Transportasi',
            ],
            [
                'nama_pekerjaan'   => 'Nelayan',
                'bidang_pekerjaan' => 'Perikanan',
            ],
            [
                'nama_pekerjaan'   => 'Ibu Rumah Tangga',
                'bidang_pekerjaan' => 'Domestik',
            ],
            [
                'nama_pekerjaan'   => 'Pelajar/Mahasiswa',
                'bidang_pekerjaan' => 'Pendidikan',
            ],
            [
                'nama_pekerjaan'   => 'Tidak Bekerja',
                'bidang_pekerjaan' => 'Lainnya',
            ],
        ];

        foreach ($data as $item) {
            Pekerjaan::create($item);
        }
    }
}
