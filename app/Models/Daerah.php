<?php

namespace App\Models;

use App\Http\Resources\JalanResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    use HasFactory;
    protected $table = "daerah";
    protected $primaryKey = "daerah_id";
    public $timestamps = false;
    public $fillable = [
        'nama_daerah'
    ];
    
    public function jalan(){
        return $this->hasMany(Jalan::class, 'daerah_id', 'daerah_id');
    }
}
