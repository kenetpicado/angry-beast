<?php

namespace App\Observers;

use App\Enums\CategoryEnum;
use App\Enums\ConceptEnum;
use Illuminate\Support\Facades\DB;

class UserObserver
{
    public function created($user)
    {
        $conceptsArray = [];
        $categoryArray = [];
        $now = now();

        foreach (ConceptEnum::cases() as $concept) {
            $conceptsArray[] = [
                'name' => $concept,
                'created_at' => $now,
                'updated_at' => $now,
                'user_id' => $user->id
            ];
        }

        foreach (CategoryEnum::cases() as $category) {
            $categoryArray[] = [
                'name' => $category,
                'created_at' => $now,
                'updated_at' => $now,
                'user_id' => $user->id
            ];
        }

        DB::table('concepts')->insert($conceptsArray);
        DB::table('categories')->insert($categoryArray);
    }
}
