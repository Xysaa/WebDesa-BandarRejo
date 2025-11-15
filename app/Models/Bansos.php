<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bansos extends Model
{
    use HasFactory;

    protected $table = 'bansos';

    protected $fillable = [
        'jenis_bansos',
        'jumlah',
        'satuan',
    ];
}
