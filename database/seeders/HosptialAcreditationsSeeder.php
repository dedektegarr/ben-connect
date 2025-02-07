<?php

namespace Database\Seeders;

use App\Models\Kesehatan\DataRS\HospitalAcreditationModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HosptialAcreditationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HospitalAcreditationModel::create(['hospital_acreditation_name'=>'Paripurna']);
        HospitalAcreditationModel::create(['hospital_acreditation_name'=>'Utama']);
        HospitalAcreditationModel::create(['hospital_acreditation_name'=>'Pengajuan Pendaftaran']);
    }
}
