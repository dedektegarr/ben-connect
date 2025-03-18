<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolModel extends Model
{
    use HasFactory;
    use HasUuids;

    public $table = "school";
    public $primaryKey = "school_id";
    public $timestamps = true;
    public $fillable = [
        'school_level_id',
        'region_id',
        'negeri_count',
        'swasta_count',
        'year'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }

    public function schoollevel()
    {
        return $this->belongsTo(SchoolLevelModel::class, 'school_level_id', 'school_level_id');
    }

    public function schoolfilter()
    {
        return $this->hasMany(SchoolFilterModel::class, 'school_filter_id', 'school_filter_id');
    }
}
