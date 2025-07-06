<?php

namespace App\Services\Barber\Resources;

use App\Models\Payment;
use Illuminate\Support\Collection;

class PaymentService
{
    /**
     * Obtener todos los pagos del barbero autenticado a través de sus reservas
     */
    public function returnAll(): Collection
    {
        return auth()->guard('barber')
            ->user()
            ->reservations()
            ->whereIn('status', ['paid', 'completed'])
            ->with('payment', 'user', 'services')
            ->has('payment') // Solo reservas que tienen pago
            ->latest()
            ->get()
            ->map(function ($reservation) {
                return $reservation->payment;
            })
            ->filter(); // Filtrar nulls por si acaso
    }

    /**
     * Obtener todos los pagos con filtros aplicados
     */
    public function returnAllWithFilters(array $filters): Collection
    {
        $query = auth()->guard('barber')
            ->user()
            ->reservations()
            ->whereIn('status', ['paid', 'completed'])
            ->with('payment', 'user', 'services')
            ->has('payment');

        // Filtro por nombre del cliente
        if (!empty($filters['client_name'])) {
            $query->whereHas('user', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['client_name'] . '%')
                  ->orWhere('last_name', 'like', '%' . $filters['client_name'] . '%');
            });
        }

        // Filtro por fecha de pago
        if (!empty($filters['payment_date'])) {
            $query->whereHas('payment', function ($q) use ($filters) {
                $q->whereDate('created_at', $filters['payment_date']);
            });
        }

        // Filtro por estado del pago
        if (!empty($filters['status'])) {
            $query->whereHas('payment', function ($q) use ($filters) {
                $q->where('status', $filters['status']);
            });
        }

        return $query->latest()
            ->get()
            ->map(function ($reservation) {
                return $reservation->payment;
            })
            ->filter();
    }

    /**
     * Obtener todos los pagos de un barbero específico (para estadísticas)
     */
    public function getPaymentsByBarber($barberId): Collection
    {
        return \App\Models\Barber::find($barberId)
            ->reservations()
            ->whereIn('status', ['paid', 'completed'])
            ->with('payment')
            ->has('payment')
            ->get()
            ->map(function ($reservation) {
                return $reservation->payment;
            })
            ->filter();
    }

    /**
     * Obtener un pago específico del barbero autenticado
     */
    public function find($id): Payment
    {
        $payment = auth()->guard('barber')
            ->user()
            ->reservations()
            ->whereIn('status', ['paid', 'completed'])
            ->with('payment.reservation.user', 'payment.reservation.services')
            ->has('payment')
            ->get()
            ->pluck('payment')
            ->where('id', $id)
            ->first();

        if (!$payment) {
            abort(404, 'Pago no encontrado o no disponible.');
        }

        return $payment;
    }

    /**
     * Verificar si un pago pertenece al barbero autenticado
     */
    public function isPaymentOwner(int $paymentId): bool
    {
        return auth()->guard('barber')
            ->user()
            ->reservations()
            ->whereIn('status', ['paid', 'completed'])
            ->has('payment')
            ->whereHas('payment', function ($query) use ($paymentId) {
                $query->where('id', $paymentId);
            })
            ->exists();
    }

    /**
     * Obtener estadísticas de pagos del barbero
     */
    public function getStats(): array
    {
        $payments = $this->returnAll();
        
        return [
            'total_payments' => $payments->count(),
            'total_amount' => $payments->sum('amount'),
            'completed_payments' => $payments->where('status', 'complete')->count(),
            'average_payment' => $payments->count() > 0 ? round($payments->avg('amount'), 2) : 0,
        ];
    }
}
