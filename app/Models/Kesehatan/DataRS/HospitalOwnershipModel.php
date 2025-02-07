<?php

namespace App\Models\Kesehatan\DataRS;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalOwnershipModel extends Model
{
    use HasFactory, HasUuids;

    protected $table='hospital_ownership';
    protected $primaryKey='hospital_ownership_id';

    public $fillable = [
        'hospital_ownership_name'
    ];

    public function categoryhospital(){
        return $this->hasMany(HospitalDataModel::class, 'hospital_ownership_id', 'hospital_ownership_id');
    }
}
