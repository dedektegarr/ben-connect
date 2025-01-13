<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    use HasFactory;

    protected $table = 'daerah';
    protected $primaryKey = 'daerah_id';
    public $timestamps = false;

    protected $fillable = [
        'nama_daerah',
        'created_at',
        'updated_at',
    ];

    // Relasi ke tabel Jalan
    public function jalan()
    {
        return $this->hasMany(Jalan::class, 'daerah_id', 'daerah_id');
    }

    // Relasi ke tabel Akta
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
