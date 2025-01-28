<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulationAgeGroup extends Model
{
    use HasFactory;
    protected $table = "population_age_group";
    protected $primaryKey = "population_age_group_id";
    public $fillable = [
        'population_age_group_years'
    ];
}
