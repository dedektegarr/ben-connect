<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'ben@admin',
            'email' => 'admin@bengkuluprov.go.id',
            'password' => bcrypt('ben@2025#')
        ])->assignRole('admin');

        User::create([
            'name' => 'ben@infrastruktur',
            'email' => 'infrastruktur@bengkuluprov.go.id',
            'password' => bcrypt('ben@2025#')
        ])->assignRole('admin-infrastruktur');
        
        User::create([
            'name' => 'ben@sosial',
            'email' => 'sosial@bengkuluprov.go.id',
            'password' => bcrypt('ben@2025#')
        ])->assignRole('admin-sosial');
    }
}
