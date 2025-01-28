<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Area::create(['area_name'=>'Kota Bengkulu']);
        Area::create(['area_name'=>'Kabupaten Bengkulu Selatan']);
        Area::create(['area_name'=>'Kabupaten Bengkulu Tengah']);
        Area::create(['area_name'=>'Kabupaten Bengkulu Tengah']);
        Area::create(['area_name'=>'Kabupaten Bengkulu Utara']);
        Area::create(['area_name'=>'Kabupaten Kaur']);
        Area::create(['area_name'=>'Kabupaten Kepahiang']);
        Area::create(['area_name'=>'Kabupaten Lebong']);
        Area::create(['area_name'=>'Kabupaten Muko-muko']);
        Area::create(['area_name'=>'Kabupaten Rejang Lebong']);
        Area::create(['area_name'=>'Kabupaten Seluma']);
        
    }
}
