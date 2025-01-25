<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komoditi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'komoditi';
    protected $primaryKey = 'komoditi_id';
    public $incrementing = false; // Pastikan UUID digunakan
    protected $keyType = 'string';

    protected $fillable = ['komoditi_name', 'color', 'pasar_id'];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class, 'pasar_id');
    }

    public function bahanPokok()
    {
        return $this->hasMany(BahanPokok::class, 'komoditi_id');
    }
}
