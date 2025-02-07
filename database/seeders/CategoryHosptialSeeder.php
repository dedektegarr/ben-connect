<?php

namespace Database\Seeders;

use App\Models\Kesehatan\DataRS\CategoryHospitalModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryHosptialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryHospitalModel::create(['category_hospital_name'=>'RSU']);
        CategoryHospitalModel::create(['category_hospital_name'=>'RSK Jiwa']);
        CategoryHospitalModel::create(['category_hospital_name'=>'RSIA']);
    }
}
