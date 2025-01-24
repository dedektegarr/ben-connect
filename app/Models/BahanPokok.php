<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanPokok extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'bahan_pokok';
    protected $primaryKey = 'bahan_pokok_id';
    public $incrementing = false; // Pastikan UUID digunakan
    protected $keyType = 'string';

    protected $fillable = ['bahan_pokok_name', 'satuan', 'harga', 'waktu', 'pasar_id', 'komoditi_id'];

    public function komoditi()
    {
        return $this->belongsTo(Komoditi::class, 'komoditi_id');
    }

    public function pasar()
    {
        return $this->belongsTo(Pasar::class, 'pasar_id');
    }
}
