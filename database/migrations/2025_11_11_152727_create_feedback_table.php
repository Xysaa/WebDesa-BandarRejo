<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            // "No" = primary key
            $table->bigIncrements('id');
            $table->string('nama', 100);
            $table->string('email', 150);
            $table->text('pesan'); // pesan / saran
            $table->date('tanggal'); // tanggal kirim
            $table->timestamps();    // created_at, updated_at
            // $table->softDeletes(); // aktifkan jika mau trash
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
