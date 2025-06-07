<?php

namespace App\Models;

# Uso de autenticacion de breeze
use Illuminate\Foundation\Auth\User as Authenticatable;

class Barber extends Authenticatable
{
    
    # Guard de Modelo : 'Barber'
    protected $guard = 'barber';

    # Atributos del Modelo
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'profile_photo',
        'description',
    ];

    # Ocultar campos importantes: contraseña y token
    protected $hidden = [
        'password',
        'remember_token',
    ];

    # Con este casting nos aseguramos que los datos que no sean string sean recuperados correctamente
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
