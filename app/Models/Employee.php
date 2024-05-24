<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'schedule',
        'user_id',
    ];

    public function payments()
    {
        return $this->morphMany(Expenditure::class, 'model');
    }
}
