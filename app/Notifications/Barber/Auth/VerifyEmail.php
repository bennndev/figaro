<?php

namespace App\Notifications\Barber\Auth;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verifyUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifica tu correo de barbero')
            ->greeting('Hola ' . $notifiable->name . ',')
            ->line('Has iniciado sesión como barbero en *El Rincón del Barbero*.')
            ->line('Confirma tu correo electrónico para continuar usando la plataforma.')
            ->action('Verificar correo', $verifyUrl)
            ->line('Si no intentaste iniciar sesión, ignora este correo.')
            ->salutation('Atentamente, El Rincón del Barbero');
    }

    protected function verificationUrl($notifiable): string
    {
        return URL::temporarySignedRoute(
            'barber.verification.verify', 
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}