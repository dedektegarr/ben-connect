<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    use HasFactory;

    protected $table = 'daerah';

    protected $fillable = [
        'nama_daerah',
        'created_at',
        'updated_at',
    ];

    // Relasi ke tabel Akta (satu daerah memiliki banyak akta)
    public function akta()
    {
        return $this->hasMany(Akta::class, 'daerah_id');
    }

    // Relasi ke tabel Angka Kemiskinan
    public function angkaKemiskinan()
    {
        return $this->hasMany(AngkaKemiskinan::class, 'daerah_id');
    }

    // Relasi ke tabel Pembangunan Gender
    public function pembangunanGender()
    {
        return $this->hasMany(PembangunanGender::class, 'daerah_id');
    }

    // Relasi ke tabel Pembangunan Manusia
    public function pembangunanManusia()
    {
        return $this->hasMany(PembangunanManusia::class, 'daerah_id');
    }

    // Relasi ke tabel Pemberdayaan Gender
    public function pemberdayaanGender()
    {
        return $this->hasMany(PemberdayaanGender::class, 'daerah_id');
    }
}
