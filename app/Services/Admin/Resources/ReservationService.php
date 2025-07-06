<?php

namespace App\Services\Admin\Resources;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ReservationService
{
    /**
     * Obtener todas las reservas con filtros aplicados
     */
    public function getFilteredReservations(array $filters = []): Collection
    {
        $query = Reservation::with(['user', 'barber', 'services', 'payment'])
            ->latest('reservation_date')
            ->latest('reservation_time');

        // Aplicar filtros
        $this->applyFilters($query, $filters);

        return $query->get();
    }

    /**
     * Obtener una reserva específica por ID
     */
    public function findReservation($id): Reservation
    {
        return Reservation::with(['user', 'barber', 'services', 'payment'])
            ->findOrFail($id);
    }

    /**
     * Aplicar filtros a la consulta
     */
    private function applyFilters(Builder $query, array $filters): void
    {
        // Filtro por nombre/apellido del cliente
        if (!empty($filters['client_name'])) {
            $clientName = $filters['client_name'];
            $query->whereHas('user', function ($q) use ($clientName) {
                $q->where(function ($subQ) use ($clientName) {
                    $subQ->where('name', 'LIKE', "%{$clientName}%")
                         ->orWhere('last_name', 'LIKE', "%{$clientName}%")
                         ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$clientName}%"]);
                });
            });
        }

        // Filtro por nombre/apellido del barbero
        if (!empty($filters['barber_name'])) {
            $barberName = $filters['barber_name'];
            $query->whereHas('barber', function ($q) use ($barberName) {
                $q->where(function ($subQ) use ($barberName) {
                    $subQ->where('name', 'LIKE', "%{$barberName}%")
                         ->orWhere('last_name', 'LIKE', "%{$barberName}%")
                         ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$barberName}%"]);
                });
            });
        }

        // Filtro por fecha de reserva (fecha única)
        if (!empty($filters['reservation_date'])) {
            $query->whereDate('reservation_date', $filters['reservation_date']);
        }

        // Filtro por rango de fechas (solo si no se especificó fecha única)
        if (empty($filters['reservation_date'])) {
            if (!empty($filters['date_from'])) {
                $query->whereDate('reservation_date', '>=', $filters['date_from']);
            }

            if (!empty($filters['date_to'])) {
                $query->whereDate('reservation_date', '<=', $filters['date_to']);
            }
        }

        // Filtro por estado
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
    }



    /**
     * Obtener los estados disponibles para filtros
     */
    public function getAvailableStatuses(): array
    {
        return [
            'pending' => 'Pendiente',
            'paid' => 'Pagado',
            'completed' => 'Completado',
            'cancelled' => 'Cancelado'
        ];
    }
}