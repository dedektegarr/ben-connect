<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadCategory extends Model
{
    use HasFactory, HasUuids;
    protected $table = "road_category";
    protected $primaryKey = "road_category_id";
    public $fillable = [
        'road_category_name'
    ];
    
    public function road(){
        return $this->belongsTo(Road::class, 'road_id', 'road_id');
    }
}
