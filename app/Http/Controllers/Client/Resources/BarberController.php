<?php

namespace App\Http\Controllers\Client\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Resources\Barber\FilterBarberRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Services\Client\Resources\BarberService;

class BarberController extends Controller
{
    public function __construct(protected BarberService $service)
    {
        
    }

    public function index(FilterBarberRequest $request)
    {
        $filters = $request->validated();
        $barbers = $this->service->filter($filters);
        $specialties = $this->service->getSpecialties();


        return view('client.resources2.barber.index', compact('barbers', 'filters', 'specialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $barber = $this->service->find($id);
        return view('client.resources.barber.show', compact('barber'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function availableSchedules(Request $request, int $barberId): \Illuminate\Http\JsonResponse
{
    // Devuelve los próximos 7 días con horarios disponibles y el id del schedule
    $schedules = \App\Models\Schedule::where('barber_id', $barberId)
        ->where('date', '>=', now()->toDateString())
        ->orderBy('date')
        ->limit(7)
        ->get(['id', 'date']);

    // Formato: [{id: 1, date: '2025-07-05'}, ...]
    return response()->json($schedules);
}

    public function availableDays($barberId)
    {
        // Busca los días próximos donde el barbero tiene horarios disponibles
        $schedules = \App\Models\Schedule::where('barber_id', $barberId)
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->limit(7)
            ->pluck('date');

        return response()->json($schedules);
    }
}
