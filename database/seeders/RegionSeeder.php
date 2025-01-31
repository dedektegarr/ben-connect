<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::create(['region_name'=>'Kota Bengkulu']);
        Region::create(['region_name'=>'Kabupaten Bengkulu Selatan']);
        Region::create(['region_name'=>'Kabupaten Bengkulu Tengah']);
        Region::create(['region_name'=>'Kabupaten Bengkulu Utara']);
        Region::create(['region_name'=>'Kabupaten Kaur']);
        Region::create(['region_name'=>'Kabupaten Kepahiang']);
        Region::create(['region_name'=>'Kabupaten Lebong']);
        Region::create(['region_name'=>'Kabupaten Muko-muko']);
        Region::create(['region_name'=>'Kabupaten Rejang Lebong']);
        Region::create(['region_name'=>'Kabupaten Seluma']);
    }
}
