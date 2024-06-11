<?php

namespace App\Services;

use App\Models\Animal;

class AnimalService
{
    public function getAnimals(array $data)
    {
        return Animal::auth()
            ->select('id', 'name', 'user_id', 'code', 'photo', 'specie_id')
            ->with('specie:id,name')
            ->when(
                isset($data['specie_id']),
                fn ($query) => $query->where('specie_id', $data['specie_id'])
            )
            ->when(
                isset($data['search']),
                fn ($query) => $query->where('name', 'like', '%' . $data['search'] . '%')->orWhere('code', 'like', '%' . $data['search'] . '%')
            )
            ->paginate();
    }

    public function store(array $data): void
    {
        if (isset($data['photo'])) {
            $temporalPhoto = $data['photo'];
            $data['photo'] = null;
        }

        $stored = Animal::create($data);

        if (isset($temporalPhoto)) {
            $file = $stored->addMedia($temporalPhoto)
                ->usingFileName($stored->id . '.' . $temporalPhoto->getClientOriginalExtension())
                ->toMediaCollection('profile');

            $stored->update(['photo' => $file->getFullUrl()]);
        }
    }

    public function updatePhoto(array $request): void
    {
        $animal = Animal::find($request['animal_id']);

        $file = $animal->addMedia($request['photo'])
            ->usingFileName($animal->id . '.' . $request['photo']->getClientOriginalExtension())
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
