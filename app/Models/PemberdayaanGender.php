<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemberdayaanGender extends Model
{
    use HasFactory;

    protected $fillable = [
        'daerah_id',
        'tahun_id',
        'jumlah',
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
