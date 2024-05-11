<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Company;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return inertia("Dashboard/User/Index", [
            'users' => User::with('company')
                ->orderBy('name')
                ->where('id', '!=', auth()->id())
                ->where('company_id', auth()->user()->company_id)
                ->paginate(),
            'companies' => Company::all('id', 'name')
        ]);
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());

        return back();
    }
}
