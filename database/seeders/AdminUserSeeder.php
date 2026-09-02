<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'jawad@gmail.com')->firstOrFail();

        $user->assignRole('admin');
        $user->givePermissionTo('manage all');
    }
}