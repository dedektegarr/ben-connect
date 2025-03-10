<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irrigation extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ["irrigation_id"];
    protected $primaryKey = "irrigation_id";
    public $incrementing = false;
    protected $keyType = "string";
    protected $table = "irrigations";

    public function scopeFilter($query, $filters)
    {
        return $query->when($filters["region"] ?? null, function ($query, $region) {
            $query->whereHas("region", function ($q) use ($region) {
                $q->where("region_name", $region);
            });
        });
    }

    public function region()
    {
        return $this->belongsTo(Region::class, "region_id", "region_id");
    }
}
