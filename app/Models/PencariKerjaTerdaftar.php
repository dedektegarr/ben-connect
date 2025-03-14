<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencariKerjaTerdaftar extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ["id"];

    public function scopeFilter($query, $filters)
    {
        return $query->when($filters["year"] ?? false, function ($q, $filter) {
            $q->where("year", $filter);
        });
    }

    public function region()
    {
        return $this->belongsTo(Region::class, "region_id");
    }
}
