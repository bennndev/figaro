<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Services\Barber\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display the dashboard with statistics and important information
     */
    public function index()
    {
        $barber = Auth::guard('barber')->user();
        
        // Obtener todas las estadísticas del dashboard
        $dashboardData = $this->dashboardService->getDashboardStats($barber->id);
        
        // Verificar si tiene horarios configurados
        $hasSchedules = $this->dashboardService->hasSchedulesConfigured($barber->id);
        
        // Obtener horarios de hoy
        $todaySchedule = $this->dashboardService->getTodaySchedule($barber->id);
        
        return view('barber.dashboard', compact(
            'dashboardData',
            'hasSchedules',
            'todaySchedule'
        ));
    }
}
