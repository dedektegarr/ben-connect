<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    use HasFactory;
    protected $table = "road";
    protected $primaryKey = "road_id";
    public $timestamps = true;
    public $fillable = [
        'dataset_id',
        'region_id',
        'road_category_id',
        'road_long'
    ];
    
    public function dataset(){
        return $this->belongsTo(Dataset::class, 'dataset_id', 'dataset_id');
    }

    public function region(){
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }

    public function roadCategory(){
        return $this->belongsTo(RoadCategory::class, 'road_category_id', 'road_category_id');
    }
}
