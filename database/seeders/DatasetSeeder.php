<?php

namespace Database\Seeders;

use App\Models\Dataset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dataset::create(['dataset_year'=>2025]);
        Dataset::create(['dataset_year'=>2024]);
        Dataset::create(['dataset_year'=>2023]);
        Dataset::create(['dataset_year'=>2022]);
    }
}
