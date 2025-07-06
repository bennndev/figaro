<?php

namespace App\Http\Controllers\Client\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Client\Resources\Reservation\CreateReservationRequest;
use App\Http\Requests\Client\Resources\Reservation\UpdateReservationRequest;
use App\Http\Requests\Client\Resources\Reservation\FilterReservationRequest;
use App\Http\Requests\Client\Resources\Reservation\AvailableSlotsRequest;

# Modelos
use App\Models\Reservation;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Specialty;
use App\Services\Client\Resources\ReservationService;

class ReservationController extends Controller
{

    # Inicializamos el constructor de nuestra clase servicio en una variable service
    public function __construct(protected ReservationService $service)
    {
        
    }

    public function index(FilterReservationRequest $request)
    {
        $filters = $request->validated(); // incluso si está vacío, mantiene el estándar
        $reservations = $this->service->filter($filters);
        $specialties = Specialty::all();
        $services    = Service::all();
        $barbers     = Barber::all();
        return view('client.resources2.reservation.index', compact('reservations', 'filters', 'specialties', 'services', 'barbers'));
    }

    public function create()
    {
        return view('client.resources2.reservation.form', 
        [ 
            'reservation' => new Reservation, 
            'barbers' => Barber::all(),
            'services' => Service::all(),
        ]);
    }

    public function store(CreateReservationRequest $request)
{
    $this->service->create($request->validated());

    // Si la petición es AJAX o espera JSON, responde JSON
    if ($request->expectsJson() || $request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Reserva creada con éxito']);
    }

    // Si es formulario tradicional, redirige
    return redirect()->route('client.reservations.index')->with('message', 'Reserva creada con éxito');
}

    public function show(int $id)
    {
        $reservation = $this->service->find($id);
        return view('client.resources2.reservation.show', compact('reservation'));
    }

    public function edit(int $id)
    {
        $reservation = $this->service->find($id);
        return view('client.resources2.reservation.edit', compact('reservation'));
    }

    public function update(UpdateReservationRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('client.reservations.index')->with('message', 'Reserva actualizada con éxito');
    }

    public function destroy(int $id)
    {
        $reservation = $this->service->find($id);

        if ($reservation->status !== 'pending_pay') {
            return redirect()->back()->with('error', 'Solo puedes cancelar reservas pendientes.');
        }

        $reservation->delete();

        return redirect()->route('client.reservations.index')
                         ->with('message', 'Reserva cancelada correctamente');
    }

    /**
     * Obtener bloques de horario disponibles (AJAX)
     */
    public function availableSlots(Request $request)
    {
        \Log::info('LLEGÓ A LA RUTA DE SLOTS ✅');
        \Log::info($request->all());

        try {
            $slots = $this->service->getAvailableSlots(
                $request->input('barber_id'),
                $request->input('schedule_id'),
                $request->input('services')
            );

            return response()->json($slots);
        } catch (\Exception $e) {
            \Log::error('Error en getAvailableSlots(): ' . $e->getMessage());
            return response()->json(['error' => 'Error interno: ' . $e->getMessage()], 500);
        }
    }
    
}
