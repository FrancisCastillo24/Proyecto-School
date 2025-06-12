<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Si estás logueado, se sabe quien ha reservado, sino aparece como NULL
        'name', // Nombre del estudiante o persona
        'event_id', // Tipo de evento
        'quantity', // Cantidad de personas
        'phone', // Teléfono de contacto
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // o Student::class
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
