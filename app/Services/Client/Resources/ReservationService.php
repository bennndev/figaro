<?php

namespace App\Services\Client\Resources;

use App\Models\Reservation;

class ReservationService{

    # Obtener todas las reservas
    public function returnAll(){
        $reservations = Reservation::all();
        return $reservations;
    }

    # Obtener una reserva
    public function find($id){
        $reservation = Reservation::findOrFail($id);
        return $reservation;
    }

    # Búsqueda por día
    public function searchByDate($date){
        $reservations = Reservation::where('reservation_date', $date)->get();
        return $reservations;
    }

    # Crear una reserva
    public function create(array $data){
        return Reservation::create($data);
    }

    # Actualizar una reserva - solo descripción
    public function update($id, array $data){
        $reservation = Reservation::findOrFail($id);
        $reservation->update($data);
        return $reservation;
    }
}