<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Resources\Reservation\FilterReservationRequest;
use App\Services\Admin\Resources\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * Mostrar listado de reservas con filtros
     */
    public function index(FilterReservationRequest $request)
    {
        // Obtener filtros validados
        $filters = $request->validated();
        
        // Obtener reservas filtradas
        $reservations = $this->reservationService->getFilteredReservations($filters);
        
        // Obtener estados disponibles para el filtro
        $statuses = $this->reservationService->getAvailableStatuses();

        return view('admin.resources2.reservation.index', compact(
            'reservations',
            'statuses',
            'filters'
        ));
    }

    /**
     * Mostrar una reserva específica
     */
    public function show(string $id)
    {
        $reservation = $this->reservationService->findReservation($id);

        return view('admin.resources2.reservation.show', compact('reservation'));
    }

    /**
     * No implementados para admin (solo lectura)
     */
    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        abort(404);
    }

    public function update(Request $request, string $id)
    {
        abort(404);
    }

    public function destroy(string $id)
    {
        abort(404);
    }
}
