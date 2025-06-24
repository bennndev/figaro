<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'duration_minutes',
        'price',
    ];
    
    protected $casts = [
        'duration_minutes' => 'integer',
        'price' => 'decimal:2',
    ];

    # Relacion de muchos a muchos -> Especialidades
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

    # Relación muchos a muchos -> Reservas
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
}
