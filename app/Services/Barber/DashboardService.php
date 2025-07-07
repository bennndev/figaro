<?php

namespace App\Services\Barber;

use App\Models\Barber;
use App\Models\Reservation;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    /**
     * Obtener todas las estadísticas del dashboard para un barbero
     */
    public function getDashboardStats($barberId)
    {
        $barber = Barber::findOrFail($barberId);
        
        return [
            'payment_stats' => $this->getPaymentStats($barber),
            'reservation_stats' => $this->getReservationStats($barber),
            'upcoming_reservations' => $this->getUpcomingReservations($barber),
            'recent_activity' => $this->getRecentActivity($barber),
            'monthly_earnings' => $this->getMonthlyEarnings($barber),
            'popular_services' => $this->getPopularServices($barber)
        ];
    }

    /**
     * Estadísticas de pagos
     */
    private function getPaymentStats($barber)
    {
        $payments = $barber->reservations()
            ->whereIn('status', ['paid', 'completed'])
            ->with('payment')
            ->has('payment')
            ->get()
            ->pluck('payment')
            ->filter();

        $completedPayments = $payments->where('status', 'complete');
        $thisMonthPayments = $completedPayments->filter(function ($payment) {
            return $payment->created_at->isCurrentMonth();
        });

        return [
            'total_payments' => $payments->count(),
            'completed_payments' => $completedPayments->count(),
            'pending_payments' => $payments->where('status', 'open')->count(),
            'total_amount' => $completedPayments->sum('amount') / 100,
            'this_month_amount' => $thisMonthPayments->sum('amount') / 100,
            'average_payment' => $completedPayments->count() > 0 ? 
                ($completedPayments->sum('amount') / 100) / $completedPayments->count() : 0,
            'this_week_amount' => $completedPayments->filter(function ($payment) {
                return $payment->created_at->isCurrentWeek();
            })->sum('amount') / 100
        ];
    }

    /**
     * Estadísticas de reservas
     */
    private function getReservationStats($barber)
    {
        $reservations = $barber->reservations();
        
        return [
            'total_reservations' => $reservations->count(),
            'completed_reservations' => $reservations->where('status', 'completed')->count(),
            'paid_reservations' => $reservations->where('status', 'paid')->count(),
            'pending_reservations' => $reservations->where('status', 'pending')->count(),
            'cancelled_reservations' => $reservations->where('status', 'cancelled')->count(),
            'today_reservations' => $reservations->whereDate('reservation_date', today())->count(),
            'this_week_reservations' => $reservations->whereBetween('reservation_date', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count(),
            'this_month_reservations' => $reservations->whereMonth('reservation_date', now()->month)
                ->whereYear('reservation_date', now()->year)->count()
        ];
    }

    /**
     * Próximas reservas (las siguientes 5)
     */
    private function getUpcomingReservations($barber)
    {
        return $barber->reservations()
            ->whereIn('status', ['pending', 'paid'])
            ->where('reservation_date', '>=', today())
            ->with(['user', 'services'])
            ->orderBy('reservation_date')
            ->orderBy('reservation_time')
            ->limit(5)
            ->get();
    }

    /**
     * Actividad reciente (últimas reservas y pagos)
     */
    private function getRecentActivity($barber)
    {
        $recentReservations = $barber->reservations()
            ->with(['user', 'services'])
            ->latest()
            ->limit(3)
            ->get()
            ->map(function ($reservation) {
                return [
                    'type' => 'reservation',
                    'data' => $reservation,
                    'created_at' => $reservation->created_at
                ];
            });

        $recentPayments = $barber->reservations()
            ->whereIn('status', ['paid', 'completed'])
            ->with('payment.reservation.user')
            ->has('payment')
            ->latest()
            ->limit(3)
            ->get()
            ->pluck('payment')
            ->map(function ($payment) {
                return [
                    'type' => 'payment',
                    'data' => $payment,
                    'created_at' => $payment->created_at
                ];
            });

        return $recentReservations->merge($recentPayments)
            ->sortByDesc('created_at')
            ->take(5)
            ->values();
    }

    /**
     * Ganancias por mes (últimos 6 meses)
     */
    private function getMonthlyEarnings($barber)
    {
        $monthlyData = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            
            $earnings = $barber->reservations()
                ->whereIn('status', ['paid', 'completed'])
                ->whereMonth('reservation_date', $date->month)
                ->whereYear('reservation_date', $date->year)
                ->with('payment')
                ->has('payment')
                ->get()
                ->pluck('payment')
                ->where('status', 'complete')
                ->sum('amount') / 100;

            $monthlyData[] = [
                'month' => $date->format('M Y'),
                'earnings' => $earnings,
                'month_number' => $date->month,
                'year' => $date->year
            ];
        }

        return $monthlyData;
    }

    /**
     * Servicios más populares
     */
    private function getPopularServices($barber)
    {
        return DB::table('reservation_service')
            ->join('reservations', 'reservation_service.reservation_id', '=', 'reservations.id')
            ->join('services', 'reservation_service.service_id', '=', 'services.id')
            ->where('reservations.barber_id', $barber->id)
            ->whereIn('reservations.status', ['paid', 'completed'])
            ->select(
                'services.name',
                'services.price',
                'services.duration_minutes',
                DB::raw('COUNT(*) as times_booked'),
                DB::raw('SUM(services.price) as total_revenue')
            )
            ->groupBy('services.id', 'services.name', 'services.price', 'services.duration_minutes')
            ->orderByDesc('times_booked')
            ->limit(5)
            ->get();
    }

    /**
     * Obtener horarios de hoy
     */
    public function getTodaySchedule($barberId)
    {
        $barber = Barber::findOrFail($barberId);
        
        return $barber->schedules()
            ->whereDate('date', today())
            ->orderBy('start_time')
            ->get();
    }

    /**
     * Verificar si el barbero tiene horarios configurados
     */
    public function hasSchedulesConfigured($barberId)
    {
        return Barber::findOrFail($barberId)
            ->schedules()
            ->exists();
    }
}