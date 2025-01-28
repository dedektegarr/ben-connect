<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulationPeriod extends Model
{
    use HasFactory;
    protected $table = "population_period";
    protected $primaryKey = "population_period_id";
    public $fillable = [
        'population_period_semester',
        'population_period_year'
    ];
}
