<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Service;

class ReservationServiceSeeder extends Seeder
{
    public function run(): void
    {
        $reservations = Reservation::all();
        $services = Service::all();

        foreach ($reservations as $reservation) {
            // Cada reservación tendrá entre 1 y 3 servicios aleatorios
            $numServices = rand(1, 3);
            $selectedServices = $services->random($numServices);
            
            foreach ($selectedServices as $service) {
                if (!$reservation->services()->where('service_id', $service->id)->exists()) {
                    $reservation->services()->attach($service->id);
                }
            }
        }
    }
}
