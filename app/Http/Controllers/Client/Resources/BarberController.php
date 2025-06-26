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

    public function availableSchedules(Request $request, int $barberId): JsonResponse
    {
        $date = $request->query('date');

        if (!$date) {
            return response()->json(['error' => 'Fecha requerida'], 422);
        }

        $schedules = $this->service->getSchedulesByDate($barberId, $date);
        return response()->json($schedules);
    }
}
