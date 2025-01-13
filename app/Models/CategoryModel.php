<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'category';

    // Primary key
    protected $primaryKey = 'category_id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'category_nama',
    ];

    // Menonaktifkan timestamps
    public $timestamps = true;

    /**
     * Relasi dengan tabel School
     */
    public function schools()
    {
        return $this->hasMany(SchoolModel::class, 'category_id', 'category_id');
    }

    /**
     * Relasi dengan tabel MeanStudy
     */
    public function meanStudies()
    {
        return $this->hasMany(MeanStudyModel::class, 'category_id', 'category_id');
    }
}
