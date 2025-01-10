<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatasetModel extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'dataset';

    // Primary key
    protected $primaryKey = 'dataset_id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'dataset_tahun',
    ];

    // Menonaktifkan timestamps
    public $timestamps = false;

    /**
     * Relasi dengan tabel School
     */
    public function schools()
    {
        return $this->hasMany(SchoolModel::class, 'dataset_id', 'dataset_id');
    }

    /**
     * Relasi dengan tabel MeanStudy
     */
    public function meanStudies()
    {
        return $this->hasMany(MeanStudyModel::class, 'dataset_id', 'dataset_id');
    }
}
