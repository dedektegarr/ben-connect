<?php

namespace App\Models\Kesehatan\DataRS;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalAcreditationModel extends Model
{
    use HasFactory, HasUuids;

    protected $table='hospital_acreditation';
    protected $primaryKey='hospital_acreditation_id';

    public $fillable = [
        'hospital_acreditation_name'
    ];

    public function categoryhospital(){
        return $this->hasMany(HospitalDataModel::class, 'hospital_acreditation_id', 'hospital_acreditation_id');
    }
}
