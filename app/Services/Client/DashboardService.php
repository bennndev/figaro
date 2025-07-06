<?php

namespace App\Services\Client;

use App\Models\Service;
use App\Models\Barber;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    /**
     * Obtiene los servicios más populares (puedes ajustar la lógica a tu gusto)
     */
    public function getPopularServices($limit = 6)
    {
        // Ejemplo: los más reservados
        return Service::with('barbers')
            ->withCount('reservations')
            ->orderByDesc('reservations_count')
            ->take($limit)
            ->get();
    }

    /**
     * Obtiene los barberos destacados (puedes ajustar la lógica)
     */
    public function getFeaturedBarbers($limit = 3)
    {
        // Ejemplo: los que más reservas tienen
        return Barber::withCount('reservations')
            ->orderByDesc('reservations_count')
            ->take($limit)
            ->get();
    }

    /**
     * Obtiene la próxima reserva del usuario autenticado
     */
    public function getNextReservation()
    {
        $user = Auth::user();
        if (!$user) return null;
        return Reservation::with(['barber', 'services'])
            ->where('user_id', $user->id)
            ->where('reservation_date', '>=', now()->toDateString())
            ->orderBy('reservation_date')
            ->orderBy('reservation_time')
            ->first();
    }
}
