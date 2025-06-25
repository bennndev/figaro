<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Reservation extends Model
{
    protected $fillable = 
    [
        'user_id',
        'barber_id',
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

    // Cliente (usuario que reserva)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Barbero
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    // Servicios seleccionados en la reserva
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
