<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoRequest;
use App\Models\Animal;
use App\Services\AnimalService;

class PhotoController extends Controller
{
    public function __construct(
        private readonly AnimalService $animalService
    ) {
    }

    public function store(PhotoRequest $request)
    {
        $this->animalService->updatePhoto($request->validated());

        return back();
    }

    public function destroy(Animal $animal)
    {
        $this->animalService->removePhoto($animal);

        return back();
    }
}
