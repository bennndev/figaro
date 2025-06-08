<?php

namespace App\Notifications\Barber\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    # Definimos el Token de la notificación
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        # Generamos la URL de restablecimiento de contraseña
        $resetUrl = url(route('barber.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        # Mensaje del mail
        
        return (new MailMessage)
            ->subject('Restablece tu contraseña de barbero')
            ->greeting('Hola, ' . $notifiable->name)
            ->line('Estás recibiendo este correo porque se solicitó un restablecimiento de contraseña para tu cuenta de barbero.')
            ->action('Restablecer contraseña', $resetUrl)
            ->line('Si no realizaste esta solicitud, puedes ignorar este mensaje.')
            ->salutation('Saludos de parte de El Rincón del Barbero');
    }

    public function toArray(object $notifiable): array
    {
        return [
            
        ];
    }
}
