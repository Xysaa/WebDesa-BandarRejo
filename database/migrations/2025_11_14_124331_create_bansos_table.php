<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bansos', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_bansos', 150);  // Jenis Bansos
            $table->integer('jumlah');            // Jumlah
            $table->string('satuan', 50);         // Satuan (kg, paket, kk, dst.)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bansos');
    }
};
