<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('description');
            $table->longText('isi');
            $table->string('author');
            $table->unsignedBigInteger('views')->default(0);
            $table->date('date');
            $table->timestamps();
            
            $table->index('slug');
            $table->index('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
