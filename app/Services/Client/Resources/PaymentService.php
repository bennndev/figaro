<?php
namespace App\Services\Client\Resources;

use App\Models\Payment;
use App\Notifications\Notifications\PaymentNotifier;

class PaymentService
{
    public function __construct(protected PaymentNotifier $notifier) {}

    /**
     * Marca el pago como completo y dispara la notificación.
     */
    public function markComplete(string $stripeSessionId): Payment
    {
        $payment = Payment::where('stripe_session_id', $stripeSessionId)
                          ->firstOrFail();

        $payment->status = 'complete';
        $payment->save();

        // -> Aquí va la notificación
        $this->notifier->notify($payment);

        return $payment;
    }
}
