<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpahMinimum extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ["id"];

    public function region()
    {
        return $this->belongsTo(Region::class, "region_id");
    }
}
