<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenditureRequest;
use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
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
