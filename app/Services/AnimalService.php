<?php

namespace App\Services;

use App\Models\Animal;

class AnimalService
{
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
}
