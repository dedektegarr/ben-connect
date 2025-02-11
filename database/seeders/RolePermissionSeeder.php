<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Setup role
        $roles = [
            'admin',
            'admin-pendidikan',
            'admin-kesehatan',
            'admin-kependudukan',
            'admin-sosial',
            'admin-infrastruktur',
            'admin-tenaga-kerja',
            'admin-ekonomi-keuangan',
            'admin-disperindag',
        ];

        //Setup Permission
        $permissions = [
            'user' => ['get', 'register', 'get-by-id', 'update', 'delete', 'update-password'],
            'dataset' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'region' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'area' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'road_category' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'road' => ['get', 'get-by-id', 'create', 'update', 'delete', 'filter'],
            'news' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'study' => ['get', 'get-by-id', 'create', 'update', 'delete', 'filter'],
            'study_level' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'region' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'variants' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'prices' => ['get', 'get-by-id', 'create', 'update', 'delete', 'filter', 'import'],
            'ikm' => ['get', 'get-by-id', 'create', 'update', 'delete', 'filter', 'import'],
            'industry' => ['get', 'get-by-id', 'create', 'update', 'delete', 'filter', 'import'],
            'kategori_rs' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'akreditasi_rs' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'kepemilikan_rs' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'population' => ['get', 'get-by-id', 'create', 'update', 'delete', 'import'],
            'population_age_group' => ['get', 'get-by-id', 'create', 'update', 'delete'],
            'population_period' => ['get', 'get-by-id', 'create', 'update', 'delete'],
        ];

        $RolePermission = [
            'admin' => [
                'user' => '*',
                'dataset' => '*',
                'area' => '*',
                'news' => '*',
                'region' => '*',
                'variants' => '*',
                'prices' => '*',
                'ikm' => '*',
                'industry' => '*',
                'road_category' => ['get', 'get-by-id'],
                'road' => ['get', 'get-by-id', 'filter'],
                'study' => '*',
                'study_level' => '*',
                'kategori_rs' => '*',
                'akreditasi_rs' => '*',
                'kepemilikan_rs' => '*'
            ],
            'admin-infrastruktur' => [
                'user' => ['update', 'update-password'],
                'dataset' => ['get', 'get-by-id'],
                'area' => ['get', 'get-by-id'],
                'road_category' => '*',
                'road' => '*'
            ],
            'admin-pendidikan' => [
                'user' => ['update', 'update-password'],
                'dataset' => ['get', 'get-by-id'],
                'region' => ['get', 'get-by-id'],
                'study' => '*',
                'study_level' => '*'
            ],
            'admin-disperindag' => [
                'user' => ['update', 'update-password'],
                'dataset' => ['get', 'get-by-id'],
                'region' => ['get', 'get-by-id'],
                'variants' => '*',
                'prices' => '*',
                'ikm' => '*',
                'industry' => '*'
            ],
            'admin-kesehatan' => [
                'user' => ['update', 'update-password'],
                'dataset' => ['get', 'get-by-id'],
                'region' => ['get', 'get-by-id'],
                'kategori_rs' => '*',
                'akreditasi_rs' => '*',
                'kepemilikan_rs' => '*'
            ],
            'admin-kependudukan' => [
                'user' => ['update', 'update-password'],
                'dataset' => ['get', 'get-by-id'],
                'region' => ['get', 'get-by-id'],
                'population' => '*',
                'population_period' => '*',
                'population_age_group' => '*'
            ]
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        foreach ($permissions as $permission => $type) {
            foreach ($type as $t) {
                Permission::create(['name' => $permission . '.' . $t]);
            }
        }

        foreach ($RolePermission as $r => $perms) {
            $role = Role::findByName($r);
            foreach ($perms as $perm => $p) {
                if ($perms[$perm] == '*') {
                    foreach ($permissions[$perm] as $prm) {
                        $role->givePermissionTo($perm . '.' . $prm);
                    }
                } else {
                    foreach ($p as $prm) {
                        $role->givePermissionTo($perm . '.' . $prm);
                    }
                }
            }
        }
    }
}
