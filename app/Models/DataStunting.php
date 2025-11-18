<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStunting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dusun',
        'jumlah_anak_stunting',
        'tahun',
        'keterangan'
    ];

    protected $casts = [
        'jumlah_anak_stunting' => 'integer',
    ];
}
