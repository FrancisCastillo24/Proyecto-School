<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'hours', 'date'];

    // Añade esta propiedad para que 'date' sea tratado como fecha
    protected $casts = [
        'date' => 'datetime',
    ];
}
