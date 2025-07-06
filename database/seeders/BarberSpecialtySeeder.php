<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barber;
use App\Models\Specialty;

class BarberSpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $barbers = Barber::all();
        $specialties = Specialty::all();

        // Asignar máximo 2 especialidades aleatorias a cada barbero
        foreach ($barbers as $barber) {
            $numSpecialties = rand(1, 2); // Entre 1 y 2 especialidades
            $selectedSpecialties = $specialties->random($numSpecialties);
            
            foreach ($selectedSpecialties as $specialty) {
                if (!$barber->specialties()->where('specialty_id', $specialty->id)->exists()) {
                    $barber->specialties()->attach($specialty->id);
                }
            }
        }
    }
}
