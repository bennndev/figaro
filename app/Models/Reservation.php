<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = 
    [
        'reservation_date',
        'reservation_time',
        'note',
        'status',
    ];

    # Casting de datos
    protected $casts =
    [
        'reservation_date' => 'date',
        'reservation_time' => 'datetime:H:i:s',
    ];
}
