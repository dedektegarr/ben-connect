<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalan extends Model
{
    use HasFactory;
    protected $table = "jalan";
    protected $primaryKey = "jalan_id";
    public $timestamps = true;
    public $fillable = [
        'tahun_data_id',
        'daerah_id',
        'kategori_jalan_id',
        'panjang'
    ];
    
    public function tahunData(){
        return $this->belongsTo(TahunData::class, 'tahun_data_id', 'tahun_data_id');
    }

    public function daerah(){
        return $this->belongsTo(Daerah::class, 'daerah_id', 'daerah_id');
    }

    public function kategoriJalan(){
        return $this->belongsTo(KategoriJalan::class, 'kategori_jalan_id', 'kategori_jalan_id');
    }
}
