<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/User/Index', [
            'users' => User::query()
                ->orderBy('name')
                ->latest()
                ->paginate(),
        ]);
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated() + [
            'password' => 'wf3LLj6QNCp5',
            'type' => 'ADMIN'
        ]);

        return back();
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return back();
    }
}
