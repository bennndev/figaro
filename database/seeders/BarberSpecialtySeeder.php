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

        // Asignar especialidades específicas a cada barbero
        $barberSpecialties = [
            // Carlos Martínez - Especialista en cortes modernos y barbas clásicas
            1 => [1, 2, 3, 6, 9, 13],
            // Miguel García - Experto en técnicas de afeitado tradicional
            2 => [3, 5, 14, 15],
            // Antonio López - Barbero con enfoque en estilos urbanos
            3 => [2, 6, 7, 11],
            // Francisco Rodríguez - Especializado en cortes clásicos y cuidado de barba premium
            4 => [1, 3, 4, 13, 14],
            // José Fernández - Barbero joven con técnicas innovadoras
            5 => [2, 6, 7, 8, 11],
            // Juan Sánchez - Veterano barbero tradicional
            6 => [1, 3, 5, 10, 13],
            // Manuel Jiménez - Especialista en barbería clásica y relajación
            7 => [1, 3, 14, 15],
            // David Ruiz - Barbero con formación internacional
            8 => [2, 6, 8, 11, 13],
            // Daniel Moreno - Experto en cortes masculinos y diseño de barbas
            9 => [1, 2, 4, 9, 11],
            // Javier Álvarez - Barbero especializado en servicios de lujo
            10 => [3, 4, 13, 14, 15],
            // Alejandro Gómez - Profesional con enfoque en tendencias actuales
            11 => [2, 6, 7, 11, 13],
            // Rafael Díaz - Barbero con experiencia en competencias
            12 => [1, 2, 6, 8, 9],
            // Pablo Castro - Especialista en cortes fade y degradado
            13 => [6, 9, 2, 11],
            // Sergio Vargas - Barbero con formación en spa y tratamientos
            14 => [14, 15, 13, 4],
            // Roberto Herrera - Veterano especializado en estilos tradicionales
            15 => [1, 3, 5, 10, 13],
        ];

        foreach ($barberSpecialties as $barberId => $specialtyIds) {
            $barber = $barbers->find($barberId);
            if ($barber) {
                foreach ($specialtyIds as $specialtyId) {
                    $specialty = $specialties->find($specialtyId);
                    if ($specialty && !$barber->specialties()->where('specialty_id', $specialty->id)->exists()) {
                        $barber->specialties()->attach($specialty->id);
                    }
                }
            }
        }
    }
}
