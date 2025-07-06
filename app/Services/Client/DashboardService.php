<?php

namespace App\Services\Client;

use App\Models\Service;
use App\Models\Barber;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
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
