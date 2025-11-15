<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('galeri_foto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul', 150);
            $table->date('tanggal');                 // tanggal foto/unggah
            $table->string('gambar_path', 255);      // path file di storage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_foto');
    }
};
