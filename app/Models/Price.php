<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $table = "prices";
    protected $primaryKey = "prices_id";

    public $fillable = [
        'prices_value',
        'date',
        'region_id',
        'variants_id'
    ];

    public function scopeFilter($query, $filters)
    {
        return $query->when($filters["region"] ?? null, function ($query, $region) {
            $query->whereHas("region", function ($q) use ($region) {
                $q->where("region_name", $region);
            });
        });
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variants_id', 'variants_id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }
}
