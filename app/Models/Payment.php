<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'reservation_id',
        'stripe_session_id',
        'amount',
        'status',
        // …
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
