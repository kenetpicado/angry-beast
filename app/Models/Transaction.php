<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'model_type',
        'user_id',
        'type',
        'description',
        'quantity',
        'value',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function scopeAuth($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
