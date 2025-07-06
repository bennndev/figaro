<?php

namespace App\Http\Controllers\Barber\Resources;

use App\Http\Controllers\Controller;

# Modelos
use App\Models\Reservation;

use App\Services\Barber\Resources\ReservationService;

class ReservationController extends Controller
{
    # Inicializamos el constructor de nuestra clase servicio en una variable service
    public function __construct(protected ReservationService $service)
    {
        
    }

    public function index()
    {
        $reservations = $this->service->returnAll();
    
        return view('barber.resources2.reservation.index', compact('reservations'));
    }

    public function show(int $id)
    {
        // Verificación de seguridad antes de buscar la reserva
        if (!$this->service->isPaidReservationOwner($id)) {
            abort(404, 'Reserva no encontrada o no disponible.');
        }
        
        $reservation = $this->service->find($id);
        
        return view('barber.resources2.reservation.show', compact('reservation'));
    }

    public function markAsCompleted(int $id)
    {
        try {
            $success = $this->service->markAsCompleted($id);
            
            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Reserva marcada como completada correctamente.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo completar la reserva. Verifica que sea tuya y esté pagada.'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la solicitud.'
            ], 500);
        }
    }
}
