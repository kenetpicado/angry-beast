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
        'photo',
        'user_id',
        'specie_id',
    ];

    public function details()
    {
        return $this->hasMany(AnimalDetail::class);
    }

    public function specie()
    {
        return $this->belongsTo(Species::class);
    }

    public function events()
    {
        return $this->morphMany(Event::class, 'model');
    }
}
