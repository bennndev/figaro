<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Resources\PaymentService;

class PaymentController extends Controller
{
    /**
     * @var PaymentService
     */
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = [
            'status' => $request->get('status', 'all'),
        ];
        $payments = $this->paymentService->getPaymentsWithFilters($filters);
        $statuses = $this->paymentService->getStatuses();
        return view('admin.payments.index', compact('payments', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Descargar PDF del pago (comprobante)
     */
    public function report($id)
    {
        $payment = \App\Models\Payment::with('reservation.services', 'reservation.user', 'reservation.barber')
            ->findOrFail($id);
        $reservation = $payment->reservation;
        $pdf = \PDF::loadView('admin.payments.report', compact('reservation', 'payment'))
            ->setPaper('a4', 'portrait');
        return $pdf->download("reporte_pago_{$payment->id}.pdf");
    }
}
