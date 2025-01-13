<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeanStudyModel extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'mean_study';

    // Primary key
    protected $primaryKey = 'mean_study_id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'daerah_id',
        'category_id',
        'quantity',
        'year_id',
    ];

    // Menonaktifkan timestamps jika tidak dibutuhkan
    public $timestamps = true;

    /**
     * Relasi ke tabel Daerah
     */
    public function daerah()
    {
        return $this->belongsTo(DaerahModel::class, 'daerah_id', 'daerah_id');
    }

    /**
     * Relasi ke tabel Category
     */
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'category_id');
    }

    /**
     * Relasi ke tabel Dataset
     */
    public function dataset()
    {
        return $this->belongsTo(DatasetModel::class, 'year_id', 'dataset_id');
    }
}
