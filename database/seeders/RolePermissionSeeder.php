<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Setup role
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'admin-pendidikan']);
        Role::create(['name'=>'admin-kesehatan']);
        Role::create(['name'=>'admin-kependudukan']);
        Role::create(['name'=>'admin-sosial']);
        Role::create(['name'=>'admin-infrastruktur']);
        Role::create(['name'=>'admin-tenaga-kerja']);
        Role::create(['name'=>'admin-ekonomi-keuangan']);
        Role::create(['name'=>'admin-disperindag']);
    }
}
