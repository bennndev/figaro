<?php

namespace App\Models;

# Uso de autenticacion de breeze
use Illuminate\Foundation\Auth\User as Authenticatable;

# Para que use notificaciones
use Illuminate\Notifications\Notifiable;

# Trait de Notificaciones
use App\Traits\Barber\SendsPasswordResetNotifications;
use App\Traits\Barber\SendEmailVerificationNotification;

# Permite habilitar la verificación de correo electrónico para este modelo
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Barber extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SendsPasswordResetNotifications, SendEmailVerificationNotification;

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

    # Relación -> 1 a muchos -> Especialidades
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

    # Relación -> 1 a muchos -> Horarios
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    # Relación -> 1 a muchos -> Reservas
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}