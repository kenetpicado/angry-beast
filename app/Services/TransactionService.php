<?php

namespace App\Services;

use App\Models\Concept;
use App\Models\Transaction;

class TransactionService
{
    public function getTransactions(array $data)
    {
        return Transaction::query()
            ->auth()
            ->with('model')
            ->latest()
            ->when(
                isset($data['type']),
                fn ($query) => $query->where('type', $data['type'])
            )
            ->when(
                isset($data['search']),
                fn ($query) => $query->where('description', 'like', '%'.$data['search'].'%')
            )
            ->when(
                isset($data['model_id']),
                fn ($query) => $query->where('model_id', $data['model_id'])->where('model_type', Concept::class)
            )
            ->when(
                isset($data['from']),
                fn ($query) => $query->whereDate('created_at', '>=', $data['from'])
            )
            ->when(
                isset($data['to']),
                fn ($query) => $query->whereDate('created_at', '<=', $data['to'])
            )
            ->paginate();
    }
}
