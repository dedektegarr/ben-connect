<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciptakarya extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ["ciptakarya_id"];
    protected $primaryKey = "ciptakarya_id";
    protected $keyType = "string";
    public $incrementing = false;

    public function scopeFilter($query, $filters)
    {
        return $query->when($filters["year"] ?? false, function ($query, $year) {
            return $query->where("tahun", $year);
        });
    }
}
