<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\DashboardService;
use App\Services\Client\DashboardStatsService;
use App\Models\Service;

class DashboardController extends Controller
{
    public function __invoke(DashboardService $dashboardService, DashboardStatsService $statsService)
    {
        $services = Service::with('barbers', 'specialties')->get();
        $barbers = $dashboardService->getFeaturedBarbers();
        $nextReservation = $dashboardService->getNextReservation();
        $stats = $statsService->getStats();
        $recentReservations = $statsService->getRecentReservations();
        return view('client.dashboard', compact('services', 'barbers', 'nextReservation', 'stats', 'recentReservations'));
    }
}
