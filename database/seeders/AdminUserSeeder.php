<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'jawad@gmail.com'],
            [
                'name' => 'Jawad',
                'password' => Hash::make('admin@1234'),
                'is_active' => true,
            ]
        );

        $user->assignRole('admin');
        $user->givePermissionTo('manage all');
        $user->givePermissionTo('view news');
        $user->givePermissionTo('create news');
        $user->givePermissionTo('edit news');
        $user->givePermissionTo('delete news');
    }
}