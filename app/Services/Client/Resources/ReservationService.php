<?php

namespace App\Services\Client\Resources;

use App\Models\Reservation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReservationService
{
    /**
     * Obtener todas las reservas del cliente autenticado
     */
    public function returnAll(): Collection
    {
        return auth()->user()
            ->reservations()
            ->with('services', 'barber')
            ->latest()
            ->get();
    }

    /**
     * Obtener una reserva específica del cliente autenticado
     */
    public function find($id): Reservation
    {
        return auth()->user()
            ->reservations()
            ->with('services', 'barber')
            ->findOrFail($id);
    }

    /**
     * Filtro por fechas y servicios
     */
    public function filter(array $filters): Collection
    {
        return auth()->user()
            ->reservations()
            ->with('services', 'barber')
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
     * Buscar reservas por fecha exacta
     */
    public function searchByDate($date): Collection
    {
        return auth()->user()
            ->reservations()
            ->where('reservation_date', $date)
            ->with('services', 'barber')
            ->get();
    }

    /**
     * Crear una nueva reserva con servicios asociados
     */
    public function create(array $data): Reservation
    {
        return DB::transaction(function () use ($data) {
            $reservation = Reservation::create([
                'user_id' => auth()->id(),
                'barber_id' => $data['barber_id'],
                'reservation_date' => $data['reservation_date'],
                'reservation_time' => $data['reservation_time'],
                'note' => $data['note'] ?? null,
                'status' => 'pending_pay',
            ]);

            $reservation->services()->sync($data['services']);

            return $reservation->load('services', 'barber');
        });
    }

    /**
     * Actualizar solo la nota de la reserva
     */
    public function update($id, array $data): Reservation
    {
        $reservation = $this->find($id);

        $reservation->update([
            'note' => $data['note'] ?? $reservation->note,
        ]);

        return $reservation;
    }
}
