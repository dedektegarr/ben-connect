<?php

namespace Database\Seeders;

use App\Models\PopulationAgeGroup;
use Carbon\Carbon;
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
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '00-04', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '05-09', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '10-14', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '15-19', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '20-24', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '25-29', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '30-34', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '35-39', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '40-44', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '45-49', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '50-54', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '55-59', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '60-64', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '65-69', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '70-74', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['population_age_group_id' => Str::uuid(), 'population_age_group_years' => '>75', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        PopulationAgeGroup::insert($populationAges);
    }
}
