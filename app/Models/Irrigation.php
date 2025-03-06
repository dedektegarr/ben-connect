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

    public function region()
    {
        return $this->belongsTo(Region::class, "region_id", "region_id");
    }
}
