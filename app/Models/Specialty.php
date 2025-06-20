<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'name'
    ];

    # Relación muchos a muchos -> Servicios
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    # Relación muchos a muchos -> Barber
    public function barbers()
    {
        return $this->belongsToMany(Barber::class);
    }
}
