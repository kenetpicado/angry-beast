<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Employee/Index', [
            'employees' => Employee::query()
                ->where('user_id', auth()->id())
                ->paginate(),
        ]);
    }

    public function store(EmployeeRequest $request)
    {
        Employee::create($request->validated());

        return back();
    }

    public function show(Employee $employee)
    {
        return inertia('Dashboard/Employee/Show', [
            'employee' => $employee,
            'payments' => $employee->payments()->latest()->paginate(),
        ]);
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return back();
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back();
    }
}
