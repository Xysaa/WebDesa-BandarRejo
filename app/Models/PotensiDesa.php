<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotensiDesa extends Model
{
    use HasFactory;

    protected $table = 'potensi_desas';

    protected $fillable = [
        'judul_potensi',
        'deskripsi',
        'gambar'
    ];
}
