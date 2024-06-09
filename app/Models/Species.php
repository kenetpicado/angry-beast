<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Species extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function scopeAuth($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function animals()
    {
        return $this->hasMany(Animal::class, 'specie_id');
    }
}
