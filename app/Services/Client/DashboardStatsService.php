<?php

namespace App\Services\Client;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardStatsService
{
    public function getStats()
    {
        $user = Auth::user();
        $total = Reservation::where('user_id', $user->id)->count();
        $completed = Reservation::where('user_id', $user->id)->whereIn('status', ['completed', 'paid'])->count();
        $cancelled = Reservation::where('user_id', $user->id)->where('status', 'cancelled')->count();
        $totalSpent = Reservation::where('user_id', $user->id)
            ->whereIn('status', ['completed', 'paid'])
            ->with('services')
            ->get()
            ->flatMap->services
            ->sum('price');
        return [
            'total' => $total,
            'completed' => $completed,
            'cancelled' => $cancelled,
            'totalSpent' => $totalSpent,
        ];
    }

    public function getRecentReservations($limit = 5)
    {
        $user = Auth::user();
        return Reservation::with(['services', 'barber'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['paid', 'completed', 'pending_pay', 'cancelled'])
            ->orderByDesc('reservation_date')
            ->orderByDesc('reservation_time')
            ->take($limit)
            ->get();
    }
}
