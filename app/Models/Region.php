<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "region";
    protected $primaryKey = "region_id";
    public $fillable = [
        'region_name',
        'region_status'
    ];
    protected $dates = ['deleted_at'];
    
    public function regionData(){
        return $this->hasMany(RegionData::class, 'region_id', 'region_id');
    }
   
}
