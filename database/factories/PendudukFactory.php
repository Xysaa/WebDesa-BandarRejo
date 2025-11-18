<?php

namespace Database\Factories;

use App\Models\Penduduk;
use App\Models\Pekerjaan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PendudukFactory extends Factory
{
    protected $model = Penduduk::class;

    public function definition(): array
    {
        // tanggal lahir antara 1 tahun s/d 80 tahun yang lalu
        $tglLahir = $this->faker->dateTimeBetween('-80 years', '-1 years');
        $tglLahirDate = Carbon::instance($tglLahir);
        $umur = $tglLahirDate->age;

        // enum yang sesuai persis dengan migration
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

        $jenisKelaminOptions = ['Laki-laki', 'Perempuan'];

        return [
            'nik'           => $this->faker->unique()->numerify(str_repeat('#', 16)), // 16 digit unik
            'no_kk'         => $this->faker->numerify(str_repeat('#', 16)),           // boleh duplikat

            'nama'          => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement($jenisKelaminOptions),

            'tgl_lahir'     => $tglLahirDate->format('Y-m-d'),
            'umur'          => $umur,

            'dusun'         => $this->faker->numberBetween(1, 7),

            'pendidikan'    => $this->faker->randomElement($pendidikanOptions),

            // pastikan sudah ada data di tabel pekerjaans (jalankan PekerjaanSeeder dulu)
            'pekerjaan_id'  => Pekerjaan::inRandomOrder()->value('id') ?? 1,

            'perkawinan'    => $this->faker->randomElement($perkawinanOptions),
            'agama'         => $this->faker->randomElement($agamaOptions),

            'alamat'        => $this->faker->streetAddress(),
        ];
    }
}
