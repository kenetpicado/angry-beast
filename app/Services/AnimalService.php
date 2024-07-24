<?php

namespace App\Services;

use App\Models\Animal;
use App\Models\AnimalDetail;

class AnimalService
{
    public function store(array $data): void
    {
        $animal = Animal::create([
            'code' => $data['code'],
            'name' => $data['name'],
            'specie_id' => $data['specie_id'],
            'user_id' => auth()->id(),
        ]);

        foreach ($data['details'] as $key => $value) {
            if (!isset($value)) {
                continue;
            }

            AnimalDetail::create([
                'key' => $key,
                'animal_id' => $animal->id,
                'value' => $value
            ]);
        }

        if (isset($data['details']['photo'])) {
            $temporalPhoto = $data['details']['photo'];
        }

        if (isset($temporalPhoto)) {
            $file = $animal->addMedia($temporalPhoto)
                ->usingFileName($animal->id.'.'.$temporalPhoto->getClientOriginalExtension())
                ->toMediaCollection('profile');

            $animal->update(['photo' => $file->getFullUrl()]);
        }
    }

    public function updatePhoto(array $request): void
    {
        $animal = Animal::find($request['animal_id']);

        $file = $animal->addMedia($request['photo'])
            ->usingFileName($animal->id.'.'.$request['photo']->getClientOriginalExtension())
            ->toMediaCollection('profile');

        $animal->update(['photo' => $file->getFullUrl()]);
    }

    public function removePhoto($animal): void
    {
        $animal->getMedia('profile')->each->delete();

        $animal->update([
            'photo' => null,
        ]);
    }
}
