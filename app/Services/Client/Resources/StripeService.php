<?php

namespace App\Services\Client\Resources;

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Service;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * @return \Stripe\Checkout\Session
     */
    public function createCheckoutSession(Service $service, string $successUrl, string $failureUrl): StripeSession
    {
        return StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items'           => [[
                'price_data' => [
                    'currency'     => 'usd',
                    'product_data' => [
                        'name' => $service->name,
                    ],
                    'unit_amount'  => (int)round($service->price * 100),
                ],
                'quantity' => 1,
            ]],
            'mode'        => 'payment',
            'success_url' => $successUrl  . '?session_id={CHECKOUT_SESSION_ID}',
            // aquí usamos tu ruta de failure
            'cancel_url'  => $failureUrl,
        ]);
    }
}
