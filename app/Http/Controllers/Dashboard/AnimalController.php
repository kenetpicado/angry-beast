<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
use App\Models\Species;
use App\Services\AnimalService;

class AnimalController extends Controller
{
    public function __construct(
        private readonly AnimalService $animalService
    ) {
    }

    public function index()
    {
        return inertia('Dashboard/Animal/Index', [
            'animals' => Animal::auth()
                ->select('id', 'name', 'user_id', 'code', 'photo')
                ->paginate(),
        ]);
    }

    public function create()
    {
        return inertia('Dashboard/Animal/Create', [
            'species' => Species::auth()->get(['id', 'name']),
        ]);
    }

    public function store(AnimalRequest $request)
    {
        $this->animalService->store($request->validated());

        return redirect()->route('dashboard.animals.index');
    }

    public function show(Animal $animal)
    {
        return inertia('Dashboard/Animal/Show', [
            'animal' => $animal->load('specie'),
            'species' => Species::auth()->get(['id', 'name']),
        ]);
    }

    public function update(AnimalRequest $request, Animal $animal)
    {
        $animal->update($request->validated());

        return back();
    }

    public function destroy(Animal $animal)
    {
        $animal->getMedia()->each->delete();

        $animal->delete();

        return back();
    }
}
