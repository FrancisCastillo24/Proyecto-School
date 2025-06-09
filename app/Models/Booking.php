<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // o Student::class
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'date_id');
    }
}
