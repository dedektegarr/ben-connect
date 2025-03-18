<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = "teacher_id";
    protected $guarded = ["teacher_id"];

    public function scopeFilter($query, $filters)
    {
        return $query->when($filters["year"] ?? null, function ($query, $year) {
            $query->where("year", $year);
        });
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }

    public function schoollevel()
    {
        return $this->belongsTo(SchoolLevelModel::class, 'school_level_id', 'school_level_id');
    }
}
