<?php

namespace App\Services;

use App\Enums\UserEnum;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function resgister(array $data): void
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'password_updated_at' => now(),
            'type' => UserEnum::USER
        ]);

        Auth::login($user);
    }
}
