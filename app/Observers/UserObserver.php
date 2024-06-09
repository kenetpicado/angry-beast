<?php

namespace App\Observers;

use App\Enums\ConceptEnum;
use App\Enums\SpeciesEnum;
use App\Enums\UserEnum;
use Illuminate\Support\Facades\DB;

class UserObserver
{
    public function created($user)
    {
        if ($user->type == UserEnum::ADMIN) {
            return;
        }

        $conceptsArray = [];
        $speciesArray = [];
        $now = now();

        foreach (ConceptEnum::cases() as $concept) {
            $conceptsArray[] = [
                'name' => $concept,
                'created_at' => $now,
                'updated_at' => $now,
                'user_id' => $user->id,
            ];
        }

        foreach (SpeciesEnum::cases() as $item) {
            $speciesArray[] = [
                'name' => $item,
                'created_at' => $now,
                'updated_at' => $now,
                'user_id' => $user->id,
            ];
        }

        DB::table('concepts')->insert($conceptsArray);
        DB::table('species')->insert($speciesArray);
    }
}
