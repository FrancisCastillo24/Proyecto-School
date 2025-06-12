<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_approved',
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
    ];

    /**
     * Comprueba si el usuario es administrador y está aprobado.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin' && $this->is_approved == 1;
    }

    /**
     * Relación: un usuario tiene un estudiante.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function events()
    {
        // return $this->hasMany(Event::class);
        return $this->hasMany(Event::class);
    }
}
