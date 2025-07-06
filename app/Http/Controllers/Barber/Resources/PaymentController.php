<?php

namespace App\Http\Controllers\Barber\Resources;

use App\Http\Controllers\Controller;
use App\Services\Barber\Resources\PaymentService;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $service)
    {
        
    }

    public function index()
    {
        $filters = [
            'client_name' => request('client_name'),
            'payment_date' => request('payment_date'),
            'status' => request('status')
        ];

        $payments = $this->service->returnAllWithFilters($filters);
        $stats = $this->service->getStats();
        
        return view('barber.resources2.payments.index', compact('payments', 'stats'));
    }

    public function show(int $id)
    {
        // Verificación de seguridad antes de buscar el pago
        if (!$this->service->isPaymentOwner($id)) {
            abort(404, 'Pago no encontrado o no disponible.');
        }
        
        $payment = $this->service->find($id);
        
        return view('barber.resources2.payments.show', compact('payment'));
    }

    public function report(int $id)
    {
        if (!$this->service->isPaymentOwner($id)) {
            abort(404, 'Pago no encontrado o no disponible.');
        }
        $payment = Payment::with('reservation.services', 'reservation.user', 'reservation.barber')
            ->findOrFail($id);
        $reservation = $payment->reservation;
        $pdf = Pdf::loadView('barber.resources2.payments.report', compact('reservation', 'payment'))
            ->setPaper('a4', 'portrait');
        return $pdf->download("reporte_pago_{$payment->id}.pdf");
    }
}
