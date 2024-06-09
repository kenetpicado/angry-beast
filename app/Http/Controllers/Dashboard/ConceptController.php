<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConceptRequest;
use App\Models\Concept;
use App\Models\Transaction;

class ConceptController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Concept/Index', [
            'concepts' => Concept::auth()
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
                ->paginate(),
        ]);
    }

    public function show(Concept $concept)
    {
        return inertia('Dashboard/Concept/Show', [
            'concept' => $concept,
            'transactions' => $concept->transactions()->latest()->paginate(),
        ]);
    }

    public function store(ConceptRequest $request)
    {
        Concept::create($request->validated());

        return back();
    }

    public function update(ConceptRequest $request, Concept $concept)
    {
        $concept->update($request->validated());

        return back();
    }

    public function destroy(Concept $concept)
    {
        if ($concept->transactions()->exists()) {
            return back()->withErrors(['message' => 'No se puede eliminar el concepto porque tiene registros relacionados']);
        }

        $concept->delete();

        return back();
    }
}
