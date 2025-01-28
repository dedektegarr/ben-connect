<?php

namespace Database\Seeders;

use App\Models\SchoolLevelModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolLevelModel::create(['school_level_name'=>'SD']);
        SchoolLevelModel::create(['school_level_name'=>'SMP']);
        SchoolLevelModel::create(['school_level_name'=>'SMA']);
        SchoolLevelModel::create(['school_level_name'=>'SMK']);
        SchoolLevelModel::create(['school_level_name'=>'SLB']);
    }
}
