<?php

namespace App\Services\Admin\Resources;

use App\Models\Payment;

class PaymentService
{
    public function getPaymentsWithFilters($filters = [])
    {
        $query = Payment::with(['reservation.user', 'reservation.services']);

        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $query->whereHas('reservation', function($q) use ($filters) {
                $q->where('status', $filters['status']);
            });
        }

        return $query->orderByDesc('created_at')->paginate(20);
    }

    public function getStatuses()
    {
        return [
            'all' => 'Todos',
            'paid' => 'Pagado',
            'pending_pay' => 'Pendiente',
            'cancelled' => 'Cancelado',
            'completed' => 'Completado',
        ];
    }
}
