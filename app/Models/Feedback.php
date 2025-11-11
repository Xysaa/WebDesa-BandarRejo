<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory; // , SoftDeletes;

    // Tabel sengaja diset ke 'feedback' (singular) biar sesuai migration.
    protected $table = 'feedback';

    protected $fillable = [
        'nama',
        'email',
        'pesan',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
