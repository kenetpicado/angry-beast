<?php

namespace App\Services;

use App\Models\Animal;
use App\Models\AnimalDetail;
use Illuminate\Support\Facades\DB;

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
            if (! isset($value)) {
                continue;
            }

            AnimalDetail::create([
                'key' => $key,
                'animal_id' => $animal->id,
                'value' => $value,
            ]);
        }

        if (isset($data['photo'])) {
            $this->storePhoto($animal, $data['photo']);
        }
    }

    public function updateAnimal(array $data, $animal): void
    {
        $keysToRemove = [];

        $animal->update([
            'code' => $data['code'],
            'name' => $data['name'],
            'specie_id' => $data['specie_id'],
        ]);

        foreach ($data['details'] as $key => $value) {
            if (! isset($value)) {
                $keysToRemove[] = $key;

                continue;
            }

            AnimalDetail::updateOrCreate([
                'key' => $key,
                'animal_id' => $animal->id,
            ], [
                'value' => $value,
            ]);
        }

        DB::table('animal_details')
            ->where('animal_id', $animal->id)
            ->whereIn('key', $keysToRemove)
            ->delete();
    }

    public function updatePhoto(array $request): void
    {
        $animal = Animal::find($request['animal_id']);
        $this->storePhoto($animal, $request['photo']);
    }

    public function removePhoto($animal): void
    {
        $animal->getMedia('profile')->each->delete();
        $animal->update(['photo' => null]);
    }

    public function storePhoto($animal, $photo)
    {
        $file = $animal->addMedia($photo)
            ->usingFileName($animal->id.'.'.$photo->getClientOriginalExtension())
            ->toMediaCollection('profile');

        $animal->update(['photo' => $file->getFullUrl()]);
    }
}
