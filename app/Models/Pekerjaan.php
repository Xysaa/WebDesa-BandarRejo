<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $fillable = [
        'nama_pekerjaan',
        'bidang_pekerjaan',
    ];

    public function penduduks()
    {
        return $this->hasMany(Penduduk::class);
    }
}
