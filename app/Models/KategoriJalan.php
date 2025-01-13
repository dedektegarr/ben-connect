<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriJalan extends Model
{
    use HasFactory;
    protected $table = "kategori_jalan";
    protected $primaryKey = "kategori_jalan_id";
    public $timestamps = false;
    public $fillable = [
        'kategori'
    ];
    
    public function jalan(){
        return $this->belongsTo(Jalan::class, 'daerah_id', 'daerah_id');
    }
}
