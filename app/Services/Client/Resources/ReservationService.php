<?php

namespace App\Services\Client\Resources;

use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Service;

use Carbon\Carbon;
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

        $reservation->services()->sync(array_values($data['services']));
        $reservation->specialties()->sync(array_values($data['specialties'])); // <-- nuevo

        return $reservation->load('services', 'barber', 'specialties');
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

/**
 * Obtener bloques de tiempo disponibles según barbero, horario y múltiples servicios
 */
    public function getAvailableSlots(int $barberId, int $scheduleId, array $serviceIds): array
    {
        $schedule = Schedule::where('barber_id', $barberId)->findOrFail($scheduleId);
        $totalDuration = (int) Service::whereIn('id', $serviceIds)->sum('duration_minutes');

        if ($totalDuration <= 0) {
            return [];
        }

        $start = Carbon::parse($schedule->start_time);
        $end = Carbon::parse($schedule->end_time);

        // 🔴 Obtenemos TODAS las reservas del barbero para ese día con sus servicios
        $reservations = Reservation::with('services')
            ->where('barber_id', $barberId)
            ->where('reservation_date', $schedule->date)
            ->get();

        // 🔐 Calculamos los rangos de tiempo ocupados
        $blockedRanges = $reservations->map(function ($reservation) {
            $start = Carbon::parse($reservation->reservation_time);
            $duration = $reservation->services->sum('duration_minutes');
            return [
                'start' => $start,
                'end' => $start->copy()->addMinutes($duration),
            ];
        });

        $availableSlots = [];

        // 📆 Generamos bloques disponibles evitando solapamientos
        while ($start->copy()->addMinutes($totalDuration)->lte($end)) {
            $slotStart = $start->copy();
            $slotEnd = $start->copy()->addMinutes($totalDuration);

            // ❌ Si se solapa con cualquier bloque reservado, se descarta
            $overlaps = $blockedRanges->contains(function ($range) use ($slotStart, $slotEnd) {
                return $slotStart->lt($range['end']) && $slotEnd->gt($range['start']);
            });

            if (! $overlaps) {
                $availableSlots[] = [
                    'start' => $slotStart->format('H:i'),
                    'end' => $slotEnd->format('H:i'),
                ];
            }

            $start->addMinutes($totalDuration);
        }

        return $availableSlots;
    }

    /**
     * Cancelar una reserva (solo si está pendiente de pago)
     */
    public function cancel($id): Reservation
    {
        $reservation = $this->find($id);
        if ($reservation->status !== 'pending_pay') {
            throw new \Exception('Solo puedes cancelar reservas pendientes.');
        }
        $reservation->status = 'cancelled';
        $reservation->save();
        return $reservation;
    }

    /**
     * Eliminar una reserva (solo si está pendiente de pago)
     */
    public function delete($id): void
    {
        $reservation = $this->find($id);
        if ($reservation->status !== 'pending_pay') {
            throw new \Exception('Solo puedes eliminar reservas pendientes.');
        }
        $reservation->delete();
    }
}
