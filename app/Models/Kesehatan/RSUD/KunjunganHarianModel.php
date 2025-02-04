<?php

namespace App\Models\Kesehatan\RSUD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganHarianModel extends Model
{
    use HasFactory;
    protected $table = "kunjungan_harian";
    protected $primaryKey = "kunjungan_harian_id";

    public $fillable = [
        'kunjungan_harian_pasien_lama',
        'kunjungan_harian_pasien_baru',
        'kunjungan_harian_tanggal',
    ];
}
