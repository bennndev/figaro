<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\DashboardService;

class DashboardController extends Controller
{
    public function __invoke(DashboardService $dashboardService)
    {
        $services = $dashboardService->getPopularServices();
        $barbers = $dashboardService->getFeaturedBarbers();
        $nextReservation = $dashboardService->getNextReservation();
        return view('client.dashboard', compact('services', 'barbers', 'nextReservation'));
    }
}
