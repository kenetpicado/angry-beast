<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['model_id', 'model_type', 'name', 'quantity'];

    public function model()
    {
        return $this->morphTo();
    }
}
