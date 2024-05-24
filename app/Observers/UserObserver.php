<?php

namespace App\Observers;

use ConceptEnum;

class UserObserver
{
    public function created($user)
    {
        $user->concepts()->createMany(ConceptEnum::cases());
    }
}
