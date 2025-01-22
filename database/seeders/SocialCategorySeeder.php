<?php

namespace Database\Seeders;

use App\Models\SocialCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialCategory::create([
            'social_category_name' => 'Akta'
        ]);
        SocialCategory::create([
            'social_category_name' => 'Indeks Angka Kemiskinan'
        ]);
        SocialCategory::create([
            'social_category_name' => 'Indeks Pembangunan Gender'
        ]);
        SocialCategory::create([
            'social_category_name' => 'Indeks Pembangunan Manusia'
        ]);
        SocialCategory::create([
            'social_category_name' => 'Indeks Pemberdayaan Gender'
        ]);
    }
}
