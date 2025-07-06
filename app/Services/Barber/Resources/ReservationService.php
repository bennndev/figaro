<?php

namespace App\Services\Barber\Resources;

use App\Models\Reservation;
use Illuminate\Support\Collection;

class ReservationService
{
    /**
     * Obtener todas las reservas pagadas del barbero autenticado
     */
    public function returnAll(): Collection
    {
        return auth()->guard('barber')
            ->user()
            ->reservations()
            ->where('status', 'paid')
            ->with('services', 'user')
            ->latest()
            ->get();
    }

    /**
     * Obtener una reserva específica pagada del barbero autenticado
     */
    public function find($id): Reservation
    {
        return auth()->guard('barber')
            ->user()
            ->reservations()
            ->where('status', 'paid')
            ->with('services', 'user')
            ->findOrFail($id);
    }

    /**
     * Filtro por fechas y servicios para reservas pagadas del barbero autenticado
     */
    public function filter(array $filters): Collection
    {
        return auth()->guard('barber')
            ->user()
            ->reservations()
            ->where('status', 'paid')
            ->with('services', 'user')
            ->when($filters['from'] ?? null, fn($q, $from) =>
                $q->where('reservation_date', '>=', $from))
            ->when($filters['to'] ?? null, fn($q, $to) =>
                $q->where('reservation_date', '<=', $to))
            ->when($filters['service_ids'] ?? null, fn($q, $ids) =>
                $q->whereHas('services', fn($q2) =>
                    $q2->whereIn('services.id', $ids)))
            ->latest()
            ->get();
    }

    /**
     * Buscar reservas pagadas por fecha exacta del barbero autenticado
     */
    public function searchByDate($date): Collection
    {
        return auth()->guard('barber')
            ->user()
            ->reservations()
            ->where('status', 'paid')
            ->where('reservation_date', $date)
            ->with('services', 'user')
            ->get();
    }

    /**
     * Obtener todas las reservas del barbero autenticado por estado específico
     * Método adicional para mayor flexibilidad futura
     */
    public function getByStatus(string $status): Collection
    {
        return auth()->guard('barber')
            ->user()
            ->reservations()
            ->where('status', $status)
            ->with('services', 'user')
            ->latest()
            ->get();
    }

    /**
     * Verificar si una reserva pertenece al barbero autenticado y está pagada
     */
    public function isPaidReservationOwner(int $reservationId): bool
    {
        return auth()->guard('barber')
            ->user()
            ->reservations()
            ->where('id', $reservationId)
            ->where('status', 'paid')
            ->exists();
    }
}
