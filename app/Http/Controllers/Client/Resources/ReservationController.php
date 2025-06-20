<?php

namespace App\Http\Controllers\Client\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Client\Resources\Reservation\CreateReservationRequest;
use App\Http\Requests\Client\Resources\Reservation\UpdateReservationRequest;
# Modelos
use App\Models\Reservation;
use App\Services\Client\Resources\ReservationService;

class ReservationController extends Controller
{

    # Inicializamos el constructor de nuestra clase servicio en una variable service
    public function __construct(protected ReservationService $service)
    {
        
    }

    public function index()
    {
        $reservations = $this->service->returnAll();
        return view('client.resources.reservation.index', compact('reservations'));
    }


    public function create()
    {
        return view('client.resources.reservation.form', [ 'reservation' => new Reservation ]);
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
        //
    }
}
