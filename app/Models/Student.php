<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

        protected $fillable = [
        'user_id',
        'address',
        'phone',
    ];

    // Un estudiante pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
