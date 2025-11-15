<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    use HasFactory;

    protected $table = 'galeri_foto';

    protected $fillable = [
        'judul',
        'tanggal',
        'gambar_path',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Accessor URL publik (storage:link wajib)
    public function getGambarUrlAttribute(): string
    {
        return asset('storage/' . $this->gambar_path);
    }
}
