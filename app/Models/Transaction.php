<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'enrollment_fee',
        'price_per_entry',
        'total_price',
    ];

    // Relación con usuario registrado
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con evento o clase
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
