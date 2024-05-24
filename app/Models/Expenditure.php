<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'model_type',
        'concept',
        'description',
        'quantity',
        'value',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
