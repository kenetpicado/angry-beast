<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Concept;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {

    }

    public function index(Request $request)
    {
        return inertia('Dashboard/Transaction/Index', [
            'transactions' => $this->transactionService->getTransactions($request->all()),
            'concepts' => Concept::auth()->get(['id', 'name']),
        ]);
    }

    public function store(TransactionRequest $request)
    {
        Transaction::create($request->validated());

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
