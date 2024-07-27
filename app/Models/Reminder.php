<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'event_id'];

    protected $casts = [
        'date' => 'date',
    ];

    protected $appends = [
        'status',
    ];

    public function getStatusAttribute()
    {
        return $this->date->diffForHumans();
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
