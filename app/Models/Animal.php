<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Animal extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'code',
        'gender',
        'race',
        'initial_weight',
        'initial_height',
        'birth_date',
        'adoption_date',
        'entry_date',
        'photo',
        'user_id',
        'specie_id'
    ];

    public function scopeAuth($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function specie()
    {
        return $this->belongsTo(Species::class);
    }
}
