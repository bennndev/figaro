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

        // Definir relaciones lógicas entre servicios y las 5 especialidades
        $relations = [
            // Servicios básicos
            1 => [1], // Corte de Cabello Clásico -> Corte Clásico
            2 => [2], // Corte Moderno Fade -> Corte Degradado
            3 => [4], // Afeitado Tradicional -> Afeitado
            4 => [4], // Arreglo de Barba Premium -> Afeitado
            5 => [1, 4], // Corte + Barba Completo -> Corte Clásico, Afeitado
            6 => [2], // Undercut Profesional -> Corte Degradado
            7 => [3], // Pompadour Styling -> Ondulado
            8 => [3], // Masaje Capilar -> Ondulado
            9 => [5], // Tratamiento Anti-Caspa -> Decoloración
            10 => [1], // Corte Infantil -> Corte Clásico
            11 => [3], // Peinado de Evento -> Ondulado
            12 => [5], // Limpieza Facial Masculina -> Decoloración
            13 => [3], // Texturizado Profesional -> Ondulado
            14 => [1], // Corte Militar -> Corte Clásico
            15 => [1, 2, 3, 4, 5], // Servicio VIP Completo -> Todas
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
