<?php

namespace App\Http\Controllers\Client\Resources;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\Client\Resources\StripeService;
use App\Models\Payment;
use Stripe\StripeClient;
use App\Models\Reservation;
class PaymentController extends Controller
{
    protected StripeService $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

public function index()
{
    $userId = auth()->id();

    // Pendientes de pago
    $pending = Reservation::with('services')
        ->where('user_id', $userId)
        ->where('status', 'pending_pay')
        ->get();

    // Historial (ya pagadas)
    $paid = Reservation::with(['services', 'payment'])
        ->where('user_id', $userId)
        ->where('status', 'paid')
        ->get();

    return view('client.resources2.payments.index', compact('pending', 'paid'));
}


// PaymentController.php
public function store(Request $request)
{
    $request->validate(['reservation_id' => 'required|exists:reservations,id']);
    $reservation = Reservation::with('services')->findOrFail($request->reservation_id);

    $session = $this->stripe->createCheckoutSession(
        $reservation,
        route('client.payments.success'),
        route('client.payments.failure')
    );

    // registra el pago vinculado a la reserva
$payment = Payment::create([
    'user_id'           => $request->user()->id,
    'reservation_id'    => $reservation->id,
    'stripe_session_id' => $session->id,
    'amount'            => $reservation->services->sum(fn($s)=> $s->price)*100,
    'status'            => 'open',
]);

    return redirect($session->url, 303);
}


public function success(Request $request)
{
    $sessionId = $request->get('session_id');
    $payment   = Payment::where('stripe_session_id', $sessionId)->firstOrFail();

    $stripe = new StripeClient(config('services.stripe.secret'));

    // Recupera la sesión de Checkout
    $session = $stripe->checkout->sessions->retrieve($sessionId);

    if ($session->payment_status !== 'paid') {
        $payment->update(['status' => 'canceled']);
        return redirect()->route('client.payments.index')
                         ->with('error', 'El pago no se completó.');
    }

    // Opcional: guarda el intent id si lo necesitas
    $payment->update([
        'status'                   => 'complete',
        'stripe_payment_intent_id' => $session->payment_intent,
    ]);
    $payment->reservation->update(['status' => 'paid']);
    return view('client.resources.payments.success', compact('payment'));
}

    public function failure()
    {
        return view('client.resources2.payments.failure');
    }
    public function show(int $id)
    {
        // Carga la reserva + pago
        $payment = Payment::with('reservation.services')
                        ->where('user_id', auth()->id())
                        ->findOrFail($id);

        return view('client.resources2.payments.show', compact('payment'));
    }
}
