<?php

namespace Database\Seeders;

use App\Enums\UserEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Demo',
            'email' => 'demo@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'password_updated_at' => now(),
            'type' => UserEnum::USER,
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'password_updated_at' => now(),
            'type' => UserEnum::ADMIN,
        ]);
    }
}
