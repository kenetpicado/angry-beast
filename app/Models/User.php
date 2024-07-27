<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company',
        'password_updated_at',
        'last_active_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_active_at' => 'datetime',
    ];

    protected $appends = [
        'active',
    ];

    public function getActiveAttribute()
    {
        if (empty($this->last_active_at)) {
            return 'Nunca';
        }

        return ($this->last_active_at > Carbon::now()->subMinutes(5)) ? 'Ahora' : $this->last_active_at->diffForHumans();
    }

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }

    public function eventTypes()
    {
        return $this->hasMany(EventType::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function species()
    {
        return $this->hasMany(Species::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
