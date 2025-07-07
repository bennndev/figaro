<?php

namespace App\Http\Controllers\Client\Resources;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\Client\Resources\StripeService;
use App\Models\Payment;
use Stripe\StripeClient;
use App\Models\Reservation;
use App\Notifications\Notifications\PaymentNotifier;
use Barryvdh\DomPDF\Facade\Pdf;
class PaymentController extends Controller
{
    protected StripeService $stripe;
    protected PaymentNotifier $notifier;
    
    public function __construct(StripeService $stripe, PaymentNotifier $notifier)
    {
        $this->stripe   = $stripe;
        $this->notifier = $notifier;
    }

public function index()
    {
        $pending = Reservation::where('user_id', auth()->id())
            ->where('status', 'pending_pay')
            ->with(['barber', 'services'])
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('client.resources2.payments.index', compact('pending'));
    }

    /**
     * Mostrar el historial de pagos del cliente
     */
    public function history()
    {
        $paid = Reservation::where('user_id', auth()->id())
            ->whereIn('status', ['paid', 'completed'])
            ->with(['barber', 'services', 'payment'])
            ->orderBy('updated_at', 'desc')
            ->paginate(6);

        return view('client.resources2.payments.history', compact('paid'));
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

        // 1) Actualizamos el pago y la reserva
    $payment->update([
        'status'                   => 'complete',
        'stripe_payment_intent_id' => $session->payment_intent,
    ]);
    $payment->reservation->update(['status' => 'paid']);

    // 2) ¡Disparamos la notificación WhatsApp!
    $this->notifier->notify($payment);

    return redirect()->route('client.payments.index')
                     ->with('success', 'Pago completado exitosamente');
}

    public function failure()
    {
        return view('client.resources.payments.cancel');

    }
    public function show(int $id)
    {
        // Carga la reserva + pago
        $payment = Payment::with('reservation.services')
                        ->where('user_id', auth()->id())
                        ->findOrFail($id);

        return view('client.resources2.payments.show', compact('payment'));
    }
        public function downloadReport(int $id)
    {
        // 1) Carga el pago con su reserva, cliente y barbero
        $payment     = Payment::with('reservation.services', 'reservation.user', 'reservation.barber')
                              ->findOrFail($id);
        $reservation = $payment->reservation;

        // 2) Genera el PDF a partir de la vista Blade
        $pdf = Pdf::loadView('client.resources2.reportes.reservation', compact('reservation', 'payment'))
      ->setPaper('a4', 'portrait');

        // 3) Devuelve la descarga
        return $pdf->download("reporte_pago_{$payment->id}.pdf");
    }

}


