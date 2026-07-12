<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'Administrator')->first();
        $studentRole = Role::where('name', 'Student')->first();

        User::create(
            [
                'uuid' => Str::uuid(),
                'role_id' => $adminRole->id,
                'name' => 'Administrator',
                'email' => 'admin@eduxamp.id',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'uuid' => Str::uuid(),
                'role_id' => $studentRole->id,
                'name' => 'Student',
                'email' => 'johndoe@eduxamp.id',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
    }
}