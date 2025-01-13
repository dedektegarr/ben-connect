<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akta extends Model
{
    use HasFactory;

    protected $fillable = [
        'daerah_id',
        'jumlah_penduduk',
        'ada',
        'tahun_id',
        'tidak_ada',
    ];

    public function daerah()
    {
        return $this->belongsTo(Daerah::class);
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }
}
