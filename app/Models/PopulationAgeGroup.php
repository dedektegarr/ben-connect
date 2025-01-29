<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopulationAgeGroup extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "population_age_group";
    protected $primaryKey = "population_age_group_id";
    public $fillable = [
        'population_age_group_years'
    ];
    protected $dates = ['deleted_at'];
}
