<?php

namespace App\Http\Controllers\Barber\Resources;

use App\Http\Controllers\Controller;
use App\Services\Barber\Resources\PaymentService;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $service)
    {
        
    }

    public function index()
    {
        $payments = $this->service->returnAll();
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
}
