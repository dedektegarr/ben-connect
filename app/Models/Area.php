<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory, HasUuids;
    protected $table = "area";
    protected $primaryKey = "area_id";
    public $fillable = [
        'area_name'
    ];
    
    public function road(){
        return $this->hasMany(Road::class, 'road_id', 'road_id');
    }
    
    public function social(){
        return $this->hasMany(Social::class, 'area_id');
    }

    public function pasar(){
        return $this->hasMany(Pasar::class, 'area_id');  
    }
    public function school(){
        return $this->hasMany(SchoolModel::class, 'area_id', 'area_id');
    }
}
