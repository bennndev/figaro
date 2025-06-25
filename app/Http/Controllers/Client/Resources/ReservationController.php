<?php

namespace App\Http\Controllers\Client\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Client\Resources\Reservation\CreateReservationRequest;
use App\Http\Requests\Client\Resources\Reservation\UpdateReservationRequest;
use App\Http\Requests\Client\Resources\Reservation\FilterReservationRequest;
# Modelos
use App\Models\Reservation;
use App\Models\Barber;
use App\Models\Service;

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
    
        return view('client.resources.reservation.index', compact('reservations', 'filters'));
    }

    public function create()
    {
        return view('client.resources.reservation.form', 
        [ 
            'reservation' => new Reservation, 
            'barbers' => Barber::all(),
            'services' => Service::all(),
        ]);
    }

    public function store(CreateReservationRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('client.reservations.index')->with('message', 'Reserva creada con éxito');
    }

    public function show(int $id)
    {
        $reservation = $this->service->find($id);
        return view('client.resources.reservation.show', compact('reservation'));
    }

    public function edit(int $id)
    {
        $reservation = $this->service->find($id);
        return view('client.resources.reservation.edit', compact('reservation'));
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
}
