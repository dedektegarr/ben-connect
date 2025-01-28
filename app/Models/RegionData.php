<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionData extends Model
{
    use HasFactory;
    protected $table = "region_data";
    protected $primaryKey = "region_data_id";
    public $fillable = [
        'region_id',
        'region_data_year',
        'region_data_area',
        'region_data_polygon'
    ];

    public function region(){
        return $this->belongsTo(Region::class, 'region_id');
    }
}
