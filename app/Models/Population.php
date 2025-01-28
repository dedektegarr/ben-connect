<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Population extends Model
{
    use HasFactory;
    protected $table = "population";
    protected $primaryKey = "population_id";
    public $fillable = [
        'population_period_id',
        'region_id',
        'population_age_group_id',
        'population_male',
        'population_female'
    ];
    
    public function populationPeriod(){
        return $this->BelongsTo(PopulationPeriod::class, 'population_period_id', 'population_period_id');
    }

    public function populationAgeGroup(){
        return $this->BelongsTo(PopulationAgeGroup::class, 'population_age_group_id', 'population_age_group_id');
    }
}
