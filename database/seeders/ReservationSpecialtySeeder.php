<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Specialty;

class ReservationSpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $reservations = Reservation::all();
        $specialties = Specialty::all();

        foreach ($reservations as $reservation) {
            // Obtener especialidades del barbero de esta reservación
            $barberSpecialties = $reservation->barber->specialties;
            
            if ($barberSpecialties->count() > 0) {
                // Asignar 1-2 especialidades por reservación
                $numberOfSpecialties = rand(1, 2);
                $selectedSpecialties = $barberSpecialties->random(min($numberOfSpecialties, $barberSpecialties->count()));
                
                foreach ($selectedSpecialties as $specialty) {
                    // Evitar duplicados
                    if (!$reservation->specialties()->where('specialty_id', $specialty->id)->exists()) {
                        $reservation->specialties()->attach($specialty->id);
                    }
                }
            } else {
                // Si el barbero no tiene especialidades, asignar especialidades básicas
                $basicSpecialties = $specialties->whereIn('id', [1, 3])->random(1);
                foreach ($basicSpecialties as $specialty) {
                    if (!$reservation->specialties()->where('specialty_id', $specialty->id)->exists()) {
                        $reservation->specialties()->attach($specialty->id);
                    }
                }
            }
        }
    }
}
