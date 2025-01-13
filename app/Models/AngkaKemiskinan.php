<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AngkaKemiskinan extends Model
{
    use HasFactory;

    protected $fillable = [
        'daerah_id',
        'tanggal_terbit',
        'jumlah',
    ];

    public function daerah()
    {
        return $this->belongsTo(Daerah::class);
    }
}
