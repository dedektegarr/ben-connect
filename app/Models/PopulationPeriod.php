<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopulationPeriod extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "population_period";
    protected $primaryKey = "population_period_id";
    public $fillable = [
        'population_period_semester',
        'population_period_year'
    ];
    protected $dates = ['deleted_at'];
}
