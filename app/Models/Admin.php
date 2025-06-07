<?php

namespace App\Models;

# Uso de autenticacion de breeze
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    
    # Guard de Modelo : 'Admin'
    protected $guard = 'admin';

    # Atributos del Modelo
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
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
