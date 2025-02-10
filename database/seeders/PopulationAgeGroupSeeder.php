<?php

namespace Database\Seeders;

use App\Models\PopulationAgeGroup;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PopulationAgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $populationAges = [
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '00-4'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '05-9'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '10-14'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '15-19'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '20-24'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '25-29'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '30-34'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '35-39'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '40-44'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '45-49'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '50-54'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '55-59'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '60-64'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '65-69'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '70-74'],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '>75'],
        ];

        PopulationAgeGroup::insert($populationAges);
    }
}
