<?php

namespace Database\Seeders;

use App\Models\PopulationPeriod;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PopulationPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periods = [
            [
                'population_period_id' => Str::uuid(),
                'population_period_semester' => 1,
                'population_period_year' => 2024,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'population_period_id' => Str::uuid(),
                'population_period_semester' => 2,
                'population_period_year' => 2024,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        PopulationPeriod::insert($periods);
    }
}
