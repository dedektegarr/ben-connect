<?php

namespace Database\Seeders;

use App\Models\Kesehatan\DataRS\HospitalOwnershipModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HosptialOwnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HospitalOwnershipModel::create(['hospital_ownership_name'=>'Pemprop']);
        HospitalOwnershipModel::create(['hospital_ownership_name'=>'Pemkab']);
        HospitalOwnershipModel::create(['hospital_ownership_name'=>'Pemkot']);
        HospitalOwnershipModel::create(['hospital_ownership_name'=>'TNI AD']);
        HospitalOwnershipModel::create(['hospital_ownership_name'=>'POLRI']);
        HospitalOwnershipModel::create(['hospital_ownership_name'=>'Swasta']);
        HospitalOwnershipModel::create(['hospital_ownership_name'=>'Organisasi Katolik']);
        HospitalOwnershipModel::create(['hospital_ownership_name'=>'Yayasan Rafflesia']);
    }
}
