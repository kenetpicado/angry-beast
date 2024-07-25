<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Transaction/Index', [
            'transactions' => auth()->user()
                ->transactions()
                ->with('model')
                ->latest()
                ->paginate(),
        ]);
    }

    public function store(TransactionRequest $request)
    {
        auth()->user()->transactions()->create($request->validated());

        return back();
    }

    public function update(TransactionRequest $request, Transaction $Transaction)
    {
        $Transaction->update($request->validated());

        return back();
    }

    public function destroy(Transaction $Transaction)
    {
        $Transaction->delete();

        return back();
    }
}
