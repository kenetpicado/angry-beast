<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpeciesRequest;
use App\Models\Animal;
use App\Models\Species;

class SpeciesController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Species/Index', [
            'species' => Species::withCount('animals')->paginate(),
            'speciesless' => Animal::auth()->whereNull('specie_id')->count(),
        ]);
    }

    public function store(SpeciesRequest $request)
    {
        Species::create($request->validated());

        return back();
    }

    public function update(SpeciesRequest $request, Species $species)
    {
        $species->update($request->validated());

        return back();
    }

    public function destroy(Species $species)
    {
        $species->delete();

        return back();
    }
}
