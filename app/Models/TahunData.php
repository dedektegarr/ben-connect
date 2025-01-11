<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunData extends Model
{
    use HasFactory;
    protected $table = "tahun_data";
    protected $primaryKey = "tahun_data_id";
    public $timestamps = false;
    public $fillable = [
        'tahun'
    ];
    
    public function jalan(){
        return $this->belongsTo(Jalan::class, 'daerah_id', 'daerah_id');
    }
}
