<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Módelo
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'name' => 'Corte de Cabello',
            'description' => 'Corte clásico y moderno según tu estilo.',
            'image' => 'corte_cabello.jpg',
            'duration_minutes' => 30,
            'price' => 15.00,
        ]);
        
        Service::create([
            'name' => 'Afeitado Tradicional',
            'description' => 'Afeitado con navaja y toalla caliente.',
            'image' => 'afeitado_tradicional.jpg',
            'duration_minutes' => 20,
            'price' => 10.00,
        ]);

        Service::create([
            'name' => 'Arreglo de Barba',
            'description' => 'Perfilado y arreglo de barba personalizado.',
            'image' => 'arreglo_barba.jpg',
            'duration_minutes' => 25,
            'price' => 12.50,
        ]);
    }
}
