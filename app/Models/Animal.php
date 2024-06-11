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
        'sex',
        'race',
        'initial_weight',
        'initial_height',
        'birth_date',
        'entry_date',
        'exit_date',
        'death_date',
        'death_cause',
        'photo',
        'user_id',
        'specie_id',
        'description',
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
