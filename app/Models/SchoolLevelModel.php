<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolLevelModel extends Model
{
    use HasFactory, HasUuids;

    public $table = "school_level";
    public $primaryKey = "school_level_id";
    public $timestamps = true;
    public $fillable = [
        'school_level_name',
    ];

    public function school()
    {
        return $this->hasMany(SchoolModel::class, 'school_level_id','school_level_id');
    }
}
