<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConceptRequest;
use App\Models\Concept;
use App\Services\ConceptService;
use Illuminate\Http\Request;

class ConceptController extends Controller
{
    public function __construct(
        private readonly ConceptService $service
    ) {
    }

    public function index()
    {
        return inertia('Dashboard/Concept/Index', [
            'concepts' => $this->service->getConcepts(),
        ]);
    }

    public function show(Request $request, Concept $concept)
    {
        return inertia('Dashboard/Concept/Show', [
            'concept' => $concept,
            'transactions' => $this->service->getConceptTransactions($concept, $request->all()),
            'transactions_total' => $this->service->getConceptTransactionsTotal($concept, $request->all()),
        ]);
    }

    public function store(ConceptRequest $request)
    {
        auth()->user()->concepts()->create($request->validated());

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
