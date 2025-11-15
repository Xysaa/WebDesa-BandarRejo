<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan folder storage/app/public/berita ada
        if (!Storage::disk('public')->exists('berita')) {
            Storage::disk('public')->makeDirectory('berita');
        }

        // Copy gambar dari public/images ke storage/app/public/berita (opsional)
        // Jika sudah ada gambar di public/images/
        for ($i = 1; $i <= 6; $i++) {
            $sourcePath = public_path("images/gambar{$i}.png");
            $destinationPath = "berita/gambar{$i}.png";
            
            if (File::exists($sourcePath)) {
                Storage::disk('public')->put(
                    $destinationPath,
                    File::get($sourcePath)
                );
            }
        }

        // Data berita dengan path storage
        $beritas = [
            [
                'slug' => 'survei-desa-bandar-rejo',
                'image' => 'berita/gambar1.png',
                'title' => 'Survei Desa Bandar Rejo',
                'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
                'isi' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo untuk mengetahui kondisi infrastruktur dan kebutuhan masyarakat. Kegiatan ini berlangsung selama 2 hari dengan melibatkan 20 mahasiswa dari berbagai jurusan. Hasil survei akan digunakan sebagai bahan penelitian dan rekomendasi pembangunan desa.',
                'author' => 'Sigit Kurnia',
                'views' => 402,
                'date' => '2025-06-23',
            ],
            [
                'slug' => 'survei-desa-bandar-rejo-2',
                'image' => 'berita/gambar2.png',
                'title' => 'Survei Desa Bandar Rejo 2',
                'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
                'isi' => 'Survei tahap kedua dilakukan dengan fokus pada sektor pertanian dan peternakan. Tim mahasiswa mengunjungi beberapa lokasi pertanian dan berdiskusi dengan petani lokal untuk memahami tantangan yang mereka hadapi.',
                'author' => 'Sigit Kurnia',
                'views' => 500,
                'date' => '2025-06-24',
            ],
            [
                'slug' => 'survei-desa-bandar-rejo-3',
                'image' => 'berita/gambar3.png',
                'title' => 'Survei Desa Bandar Rejo 3',
                'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
                'isi' => 'Pada hari ketiga, survei difokuskan pada aspek sosial dan budaya masyarakat desa. Mahasiswa melakukan wawancara mendalam dengan tokoh masyarakat dan mengamati kegiatan adat yang masih dilestarikan.',
                'author' => 'Sigit Kurnia',
                'views' => 305,
                'date' => '2025-06-25',
            ],
            [
                'slug' => 'survei-desa-bandar-rejo-4',
                'image' => 'berita/gambar4.png',
                'title' => 'Survei Desa Bandar Rejo 4',
                'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
                'isi' => 'Tim survei melakukan pemetaan potensi ekonomi desa termasuk UMKM dan produk unggulan lokal. Mereka menemukan beberapa produk menarik yang berpotensi dikembangkan menjadi produk komersial.',
                'author' => 'Sigit Kurnia',
                'views' => 700,
                'date' => '2025-06-26',
            ],
            [
                'slug' => 'survei-desa-bandar-rejo-5',
                'image' => 'berita/gambar5.png',
                'title' => 'Survei Desa Bandar Rejo 5',
                'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
                'isi' => 'Survei kelima memfokuskan pada sistem pendidikan dan kesehatan di desa. Mahasiswa mengunjungi sekolah dan puskesmas untuk mengevaluasi fasilitas yang tersedia dan kebutuhan yang harus dipenuhi.',
                'author' => 'Sigit Kurnia',
                'views' => 450,
                'date' => '2025-06-27',
            ],
            [
                'slug' => 'survei-desa-bandar-rejo-6',
                'image' => 'berita/gambar6.png',
                'title' => 'Survei Desa Bandar Rejo 6',
                'description' => 'Mahasiswa ITERA melakukan survei di Desa Bandar Rejo.',
                'isi' => 'Sebagai penutup, tim mempresentasikan hasil survei kepada perangkat desa dan masyarakat. Mereka memberikan beberapa rekomendasi untuk pengembangan desa ke depan yang disambut baik oleh warga.',
                'author' => 'Sigit Kurnia',
                'views' => 600,
                'date' => '2025-06-28',
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
