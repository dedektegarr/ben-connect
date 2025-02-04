<?php

namespace App\Models\Kesehatan\RSUD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganBulananModel extends Model
{
    use HasFactory;
    protected $table = "kunjungan_bulanan";
    protected $primaryKey = "kunjungan_bulanan_id";

    public $fillable = [
        'kunjungan_bulanan_pasien_lama',
        'kunjungan_bulanan_pasien_baru',
        'kunjungan_bulanan_bulan',
        'kunjungan_bulanan_tahun',
    ];
}
