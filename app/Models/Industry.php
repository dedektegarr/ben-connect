<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    protected $table = 'industries';
    protected $primaryKey = 'industry_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;


    protected $fillable = [
        'industry_ptname',
        'industry_headoffice_address',
        'industry_office_province',
        'industry_city_office',
        'industry_factory_address',
        'industry_factory_province',
        'region_id',
        'industry_kd_kbli',
        'industry_business_fields',
        'industry_business_scale',
        'industry_registered_sinas',
    ];

    protected $hidden = [
        "region_id",
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }
}
