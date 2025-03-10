<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    use HasUuids, HasFactory;

    protected $table = "road";
    protected $primaryKey = "road_id";
    public $timestamps = true;
    public $guarded = ["road_id"];

    public function scopeFilter($query, $filters)
    {
        return $query->when($filters["year"] ?? null, function ($query, $year) {
            $query->where("tahun", $year);
        });
    }

    public function dataset()
    {
        return $this->belongsTo(Dataset::class, 'dataset_id', 'dataset_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }

    public function roadCategory()
    {
        return $this->belongsTo(RoadCategory::class, 'road_category_id', 'road_category_id');
    }
}
