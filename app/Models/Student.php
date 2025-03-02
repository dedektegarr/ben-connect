<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = "student_id";
    protected $guarded = ["student_id"];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }

    public function schoollevel()
    {
        return $this->belongsTo(SchoolLevelModel::class, 'school_level_id', 'school_level_id');
    }
}
