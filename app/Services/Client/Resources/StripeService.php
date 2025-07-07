<?php

namespace App\Services\Client\Resources;

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Service;
use App\Models\Reservation;
use Stripe\Checkout\Session;
class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * @return \Stripe\Checkout\Session
     */
    // StripeService.php
public function createCheckoutSession(Reservation $reservation, string $successUrl, string $cancelUrl)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    // arma los line_items a partir de todos los servicios en la reserva
    $items = $reservation->services->map(function($service) {
        return [
          'price_data' => [
            'currency'     => 'pen',
            'product_data' => ['name' => $service->name],
            'unit_amount'  => (int)round($service->price * 100),
          ],
          'quantity' => $service->pivot->quantity ?? 1,
        ];
    })->all();

    return Session::create([
        'payment_method_types' => ['card'],
        'line_items'           => $items,
        'mode'                 => 'payment',
        'success_url'          => $successUrl  . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url'           => $cancelUrl,
    ]);
}

}
