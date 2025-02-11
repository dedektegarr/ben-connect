<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Population extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "population";
    protected $primaryKey = "population_id";
    public $fillable = [
        'population_period_id',
        'region_id',
        'population_age_group_id',
        'population_male',
        'population_female'
    ];

    public function scopeFilter($query, $filters)
    {
        return $query->when($filters["year"] ?? null, function ($query, $year) {
            $query->whereHas("populationPeriod", function ($q) use ($year) {
                $q->where("population_period_year", $year);
            });
        })->when($filters["semester"] ?? null, function ($query, $semester) {
            $query->whereHas("populationPeriod", function ($q) use ($semester) {
                $q->where("population_period_semester", $semester);
            });
        })->when($filters["age_range"] ?? null, function ($query, $age_range) {
            $query->whereHas("populationAgeGroup", function ($q) use ($age_range) {
                $q->where("population_age_group_years", $age_range);
            });
        })->when($filters["region"] ?? null, function ($query, $region) {
            $query->whereHas("region", function ($q) use ($region) {
                $q->where("region_name", $region);
            });
        });
    }

    public function populationPeriod()
    {
        return $this->BelongsTo(PopulationPeriod::class, 'population_period_id', 'population_period_id');
    }

    public function populationAgeGroup()
    {
        return $this->BelongsTo(PopulationAgeGroup::class, 'population_age_group_id', 'population_age_group_id');
    }
    public function region()
    {
        return $this->BelongsTo(Region::class, 'region_id');
    }
}
