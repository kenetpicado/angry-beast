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
        User::create($request->validated());

        return back();
    }
}
