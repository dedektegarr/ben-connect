<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;

    protected $table = 'tahun';

    protected $fillable = [
        'tahun',
    ];

    // Relasi ke tabel Akta (satu tahun memiliki banyak akta)
    public function akta()
    {
        return $this->hasMany(Akta::class, 'tahun_id');
    }

    // Relasi ke tabel Pembangunan Gender
    public function pembangunanGender()
    {
        return $this->hasMany(PembangunanGender::class, 'tahun_id');
    }

    // Relasi ke tabel Pemberdayaan Gender
    public function pemberdayaanGender()
    {
        return $this->hasMany(PemberdayaanGender::class, 'tahun_id');
    }
}
