<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'no_kk',
        'nama',
        'jenis_kelamin',
        'tgl_lahir',
        'umur',
        'dusun',
        'pendidikan',
        'pekerjaan_id',
        'perkawinan',
        'agama',
        'alamat',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    // optional: helper untuk hitung umur kalau mau dipakai di tempat lain
    public function getUmurAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->tgl_lahir) {
            return Carbon::parse($this->tgl_lahir)->age;
        }

        return null;
    }
}
