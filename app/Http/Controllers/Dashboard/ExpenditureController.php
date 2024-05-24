<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenditureRequest;
use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Expenditure/Index', [
            'expenditures' => Expenditure::query()
                ->with('model')
                ->where('user_id', auth()->id())
                ->latest()
                ->paginate(),
            'concepts' => auth()->user()->concepts()->get(['id', 'name']),
        ]);
    }

    public function store(ExpenditureRequest $request)
    {
        Expenditure::create($request->validated());

        return back();
    }

    public function update(ExpenditureRequest $request, Expenditure $expenditure)
    {
        $expenditure->update($request->validated());

        return back();
    }

    public function destroy(Expenditure $expenditure)
    {
        $expenditure->delete();

        return back();
    }
}
