<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $service
    ) {
    }

    public function index(Request $request)
    {
        return inertia('Dashboard/Transaction/Index', [
            'transactions' => $this->service->getTransactions($request->all()),
            'transactions_total' => $this->service->getTransactionsTotal($request->all()),
        ]);
    }

    public function store(TransactionRequest $request)
    {
        auth()->user()->transactions()->create($request->validated() + [
            'total' => $request->value * $request->quantity,
        ]);

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
