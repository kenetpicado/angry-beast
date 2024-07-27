<?php

namespace App\Services;

use App\Models\Concept;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ConceptService
{
    public function getConcepts()
    {
        return auth()->user()->concepts()
            ->latest()
            ->select(['id', 'name', 'user_id'])
            ->addSelect([
                'last_egreso' => Transaction::select('created_at')
                    ->where('model_type', Concept::class)
                    ->whereColumn('model_id', 'concepts.id')
                    ->where('type', 'EGRESO')
                    ->latest()
                    ->limit(1),
                'last_ingreso' => Transaction::select('created_at')
                    ->where('model_type', Concept::class)
                    ->whereColumn('model_id', 'concepts.id')
                    ->where('type', 'INGRESO')
                    ->latest()
                    ->limit(1),
            ])
            ->paginate();
    }

    public function getConceptTransactions($concept, array $data = [])
    {
        return $concept
            ->transactions()
            ->searching($data)
            ->latest()
            ->paginate();
    }

    public function getConceptTransactionsTotal($concept, array $data = [])
    {
        return $concept
            ->transactions()
            ->searching($data)
            ->groupBy('type')
            ->get(['type', DB::raw('count(*) as count, sum(total) as total')]);
    }
}
