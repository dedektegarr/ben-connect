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
}
