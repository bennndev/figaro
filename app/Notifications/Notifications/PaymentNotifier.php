<?php

namespace App\Notifications\Notifications;

use App\Models\Payment;
use App\Services\Notifications\WhatsappService;

class PaymentNotifier
{
    protected WhatsappService $whatsapp;

    public function __construct(WhatsappService $whatsapp)
    {
        $this->whatsapp = $whatsapp;
    }

    /**
     * Envía notificaciones WhatsApp tras el pago completado.
     */
    public function notify(Payment $payment): void
{
    $reservation = $payment->reservation;
    $cliente     = $payment->user;
    $barbero     = $reservation->barber;

    // Nótese que usamos phone_number, no phone
    $clientePhone = $cliente->phone_number;
    $barberoPhone = $barbero->phone_number;

    $msgCliente = "Hola {$cliente->name}, de la barbería Figaro, hemos recibido tu pago de S/".number_format($payment->amount/100,2)
                ." por la reserva del {$reservation->reservation_date} a las {$reservation->reservation_time}, no olvides llegar 5 minutos antes, ¡Gracias!";

    $msgBarbero = "Hola {$barbero->name}, en la barbería Figaro, el cliente {$cliente->name} ha pagado S/".number_format($payment->amount/100,2)
                ." para la reserva del {$reservation->reservation_date} a las {$reservation->reservation_time}, no olvides estar a tiempo para el servicio al cliente <3.";

    if ($clientePhone) {
        $this->whatsapp->sendMessage($clientePhone, $msgCliente);
    }

    if ($barberoPhone) {
        $this->whatsapp->sendMessage($barberoPhone, $msgBarbero);
    }
}
}
