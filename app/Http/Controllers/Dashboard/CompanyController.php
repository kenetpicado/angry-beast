<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return inertia("Dashboard/Company/Index", [
            'companies' => Company::select('id', 'name')->paginate()
        ]);
    }

    public function store(CompanyRequest $request)
    {
        Company::create($request->validated());

        return back();
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return back();
    }
}
