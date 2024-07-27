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
        'total',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function scopeAuth($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeSearching($query, $data = [])
    {
        return $query
            ->when(
                isset($data['type']),
                fn ($query) => $query->where('type', $data['type'])
            )
            ->when(
                isset($data['search']),
                fn ($query) => $query->where('description', 'like', '%'.$data['search'].'%')
            )
            ->when(
                isset($data['from']),
                fn ($query) => $query->whereDate('created_at', '>=', $data['from'])
            )
            ->when(
                isset($data['to']),
                fn ($query) => $query->whereDate('created_at', '<=', $data['to'])
            );
    }
}
