<?php

namespace App\Models\Kesehatan\DataRS;

use App\Models\Region;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalDataModel extends Model
{
    use HasFactory, HasUuids;

    protected $table='hospital_data';
    protected $primaryKey='hospital_data_id';

    public $fillable = [
        'hospital_data_name',
        'hospital_data_nib',
        'hospital_data_class',
        'hospital_data_telp',
        'hospital_data_email',
        'hospital_data_longitude',
        'hospital_data_latitude'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }

    public function category_hospital()
    {
        return $this->belongsTo(CategoryHospitalModel::class, 'category_hospital_id', 'category_hospital_id');
    }

    public function hospital_acreditation()
    {
        return $this->belongsTo(HospitalAcreditationModel::class, 'hospital_acreditation_id', 'hospital_acreditation_id');
    }

    public function hospital_ownership()
    {
        return $this->belongsTo(HospitalOwnershipModel::class, 'hospital_ownership_id', 'hospital_ownership_id');
    }
}
