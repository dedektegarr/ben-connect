<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaerahModel extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'daerah';

    // Primary key
    protected $primaryKey = 'daerah_id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'daerah_nama',
    ];

    // Menonaktifkan timestamps
    public $timestamps = false;

    /**
     * Relasi dengan tabel School
     */
    public function schools()
    {
        return $this->hasMany(SchoolModel::class, 'daerah_id', 'daerah_id');
    }

    /**
     * Relasi dengan tabel MeanStudy
     */
    public function meanStudies()
    {
        return $this->hasMany(MeanStudyModel::class, 'daerah_id', 'daerah_id');
    }
}
