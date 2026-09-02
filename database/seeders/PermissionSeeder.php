<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Permission::firstOrCreate([ 
            'name' => 'manage all', 
            'guard_name' => 'web', 
        ]);

        Permission::firstOrCreate([
            'name' => 'view news',
            'guard_name' => 'web',
        ]);

        Permission::firstOrCreate([
            'name' => 'create news',
            'guard_name' => 'web',
        ]);

        Permission::firstOrCreate([
            'name' => 'edit news',
            'guard_name' => 'web',
        ]);

        Permission::firstOrCreate([
            'name' => 'delete news',
            'guard_name' => 'web',
        ]);
    }
}
