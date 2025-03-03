<?php

namespace App\Models\Kesehatan\DataRS;

use App\Models\Region;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalDataModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'hospital_data';
    protected $primaryKey = 'hospital_data_id';

    public $fillable = [
        'category_hospital_id',
        'hospital_acreditation_id',
        'region_id',
        'hospital_ownership_id',
        'hospital_data_name',
        'hospital_data_nib',
        'hospital_data_class',
        'hospital_data_telp',
        'hospital_data_email',
        'hospital_data_longitude',
        'hospital_data_latitude'
    ];

    public function scopeFilter($query, $filters)
    {
        return $query->when($filters["region"] ?? null, function ($query, $region) {
            $query->whereHas("region", function ($q) use ($region) {
                $q->where("region_name", $region);
            });
        })->when($filters["category"] ?? null, function ($query, $category) {
            $query->whereHas("category_hospital", function ($q) use ($category) {
                $q->where("category_hospital_name", $category);
            });
        })->when($filters["ownership"] ?? null, function ($query, $ownership) {
            $query->whereHas("hospital_ownership", function ($q) use ($ownership) {
                $q->where("hospital_ownership_name", $ownership);
            });
        })->when($filters["acreditation"] ?? null, function ($query, $acreditation) {
            $query->whereHas("hospital_acreditation", function ($q) use ($acreditation) {
                $q->where("hospital_acreditation_name", $acreditation);
            });
        });
    }

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
