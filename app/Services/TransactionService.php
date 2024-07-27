<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function getTransactions(array $data)
    {
        return auth()->user()->transactions()
            ->with('model')
            ->latest()
            ->searching($data)
            ->paginate();
    }

    public function getTransactionsTotal(array $data)
    {
        return auth()->user()->transactions()
            ->searching($data)
            ->groupBy('type')
            ->get(['type', DB::raw('count(*) as count, sum(total) as total')]);
    }
}
