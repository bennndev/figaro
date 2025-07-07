<?php

namespace App\Services\Admin;

use App\Models\Reservation;
use App\Models\Payment;
use App\Models\User;
use App\Models\Barber;
use Carbon\Carbon;

class DashboardService
{
    public function getKpis()
    {
        $today = Carbon::today();
        $month = Carbon::now()->startOfMonth();

        return [
            'reservas_hoy' => Reservation::whereDate('reservation_date', $today)->count(),
            'reservas_mes' => Reservation::where('reservation_date', '>=', $month)->count(),
            'ingresos_hoy' => Payment::whereDate('updated_at', $today)->sum('amount') / 100,
            'ingresos_mes' => Payment::where('updated_at', '>=', $month)->sum('amount') / 100,
            'pendientes' => Reservation::where('status', 'pending_pay')->count(),
            'completadas' => Reservation::where('status', 'completed')->count(),
            'canceladas' => Reservation::where('status', 'cancelled')->count(),
            'clientes' => User::count(),
            'barberos' => Barber::count(),
        ];
    }

    public function getReservasChartData($days = 14)
    {
        $from = Carbon::now()->subDays($days-1)->startOfDay();
        $data = Reservation::selectRaw('DATE(reservation_date) as date, COUNT(*) as total')
            ->where('reservation_date', '>=', $from)
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $labels = [];
        $values = [];
        for ($i = 0; $i < $days; $i++) {
            $date = $from->copy()->addDays($i)->format('Y-m-d');
            $labels[] = date('d/m', strtotime($date));
            $values[] = $data->firstWhere('date', $date)->total ?? 0;
        }
        return compact('labels', 'values');
    }

    public function getUltimasReservas($limit = 8)
    {
        return Reservation::with(['user', 'barber'])
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    public function getTopServicios($limit = 5)
    {
        return \DB::table('reservation_service')
            ->join('services', 'reservation_service.service_id', '=', 'services.id')
            ->select('services.name', \DB::raw('COUNT(*) as total'))
            ->groupBy('services.name')
            ->orderByDesc('total')
            ->limit($limit)
            ->get();
    }
}
