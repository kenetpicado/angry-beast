<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
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
            'animals' => Animal::query()
                ->where('user_id', auth()->id())
                ->select('id', 'name', 'user_id', 'code', 'photo')
                ->paginate(),
        ]);
    }

    public function create()
    {
        return inertia('Dashboard/Animal/Create');
    }

    public function store(AnimalRequest $request)
    {
        $this->animalService->store($request->validated());

        return redirect()->route('dashboard.animals.index');
    }

    public function show(Animal $animal)
    {
        return inertia('Dashboard/Animal/Show', compact('animal'));
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
