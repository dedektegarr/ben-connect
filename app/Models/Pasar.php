<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pasar';
    protected $primaryKey = 'pasar_id';
    public $incrementing = false; // Pastikan UUID digunakan
    protected $keyType = 'string';

    protected $fillable = ['pasar_name', 'latitude', 'longitude','region_id'];

    public function komoditi()
    {
        return $this->hasMany(Komoditi::class, 'id_pasar');
    }

    public function region(){
        return $this->belongsTo(Region::class, 'region_id');
    }
}
