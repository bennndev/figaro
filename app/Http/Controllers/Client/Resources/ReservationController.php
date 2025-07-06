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
            'specialties' => Specialty::all(),
        ]);
    }

    public function store(CreateReservationRequest $request)
    {
        $data = $request->validated();
        // Adaptar specialties y services si vienen como campos individuales
        if (empty($data['specialties']) && !empty($request->input('specialty_id'))) {
            $data['specialties'] = [$request->input('specialty_id')];
        }
        if (empty($data['services']) && !empty($request->input('service_id'))) {
            $data['services'] = [$request->input('service_id')];
        }
        $reservation = $this->service->create($data);
        // Stripe Checkout
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $user = auth()->user();
        $service = $reservation->services->first();
        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'pen',
                    'product_data' => [
                        'name' => $service->name,
                        'description' => $service->description,
                    ],
                    'unit_amount' => intval($service->price * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'customer_email' => $user->email,
            'success_url' => route('client.payments.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('client.payments.failure'),
            'metadata' => [
                'reservation_id' => $reservation->id,
                'user_id' => $user->id,
            ],
        ]);
        return redirect($checkoutSession->url);
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
        try {
            $this->service->delete($id);
            return redirect()->route('client.reservations.index')->with('message', 'Reserva eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
    
    public function cancel($id)
    {
        try {
            $this->service->cancel($id);
            return redirect()->route('client.reservations.index')->with('message', 'Reserva cancelada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
