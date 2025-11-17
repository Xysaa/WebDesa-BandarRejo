<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();

            $table->string('nik', 16)->unique();
            $table->string('no_kk', 16);

            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);

            $table->date('tgl_lahir');
            $table->unsignedTinyInteger('umur'); // disimpan otomatis dari tgl_lahir

            $table->unsignedTinyInteger('dusun'); // 1-7

            $table->enum('pendidikan', [
                'Tidak / Belum Sekolah',
                'Belum Tamat SD Sederajat',
                'Tamat SD Sederajat',
                'SLTP Sederajat',
                'SLTA Sederajat',
                'Diploma I',
                'Diploma III',
                'Diploma IV',
                'Strata 1',
            ]);

            // relasi ke tabel pekerjaan
            $table->foreignId('pekerjaan_id')->constrained('pekerjaans');

            $table->enum('perkawinan', [
                'Belum Kawin',
                'Kawin',
                'Cerai Mati',
                'Kawin Tercatat',
                'Cerai Hidup',
                'Kawin Tidak Tercatat',
            ]);

            $table->enum('agama', [
                'Islam',
                'Katolik',
                'Hindu',
                'Budha',
                'Konghucu',
                'Kristen',
                'Kepercayaan Lainnya',
            ]);

            $table->string('alamat');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
