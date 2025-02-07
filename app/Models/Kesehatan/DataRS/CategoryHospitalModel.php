<?php

namespace App\Models\Kesehatan\DataRS;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryHospitalModel extends Model
{
    use HasFactory, HasUuids;

    protected $table='category_hospital';
    protected $primaryKey='category_hospital_id';

    public $fillable = [
        'category_hospital_name'
    ];

    public function categoryhospital(){
        return $this->hasMany(HospitalDataModel::class, 'category_hospital_id', 'category_hospital_id');
    }
}
