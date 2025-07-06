<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Specialty;

class ServiceSpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::all();
        $specialties = Specialty::all();

        // Definir relaciones lógicas entre servicios y especialidades
        $relations = [
            // Corte de Cabello Clásico
            1 => [1, 9, 13], // Corte Clásico, Degradado, Styling
            // Corte Moderno Fade  
            2 => [2, 6, 9], // Corte Moderno, Fade, Degradado
            // Afeitado Tradicional
            3 => [5], // Afeitado
            // Arreglo de Barba Premium
            4 => [3, 4], // Barba Tradicional, Barba Hipster
            // Corte + Barba Completo
            5 => [1, 2, 3, 4, 13], // Múltiples especialidades
            // Undercut Profesional
            6 => [7, 2], // Undercut, Corte Moderno
            // Pompadour Styling
            7 => [8, 13], // Pompadour, Styling
            // Masaje Capilar
            8 => [15], // Masaje Capilar
            // Tratamiento Anti-Caspa
            9 => [14], // Tratamiento Capilar
            // Corte Infantil
            10 => [1, 2], // Corte Clásico, Corte Moderno
            // Peinado de Evento
            11 => [13, 8], // Styling, Pompadour
            // Limpieza Facial Masculina
            12 => [14], // Tratamiento Capilar
            // Texturizado Profesional
            13 => [11, 2], // Texturizado, Corte Moderno
            // Corte Militar
            14 => [10], // Corte Militar
            // Servicio VIP Completo
            15 => [1, 2, 3, 4, 13, 14, 15], // Múltiples especialidades VIP
        ];

        foreach ($relations as $serviceId => $specialtyIds) {
            $service = $services->find($serviceId);
            if ($service) {
                foreach ($specialtyIds as $specialtyId) {
                    $specialty = $specialties->find($specialtyId);
                    if ($specialty) {
                        $service->specialties()->attach($specialty->id);
                    }
                }
            }
        }
    }
}
