<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function resgister(array $data): void
    {
        $company = Company::firstOrCreate([
            'name' => $data['company'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'company_id' => $company->id,
            'password_updated_at' => now(),
        ]);

        event(new Registered($user));

        Auth::login($user);
    }
}
