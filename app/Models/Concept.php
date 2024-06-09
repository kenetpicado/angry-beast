<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function scopeAuth($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'model');
    }
}
