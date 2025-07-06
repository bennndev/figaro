<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Modelo
use App\Models\Specialty;
class SpecialtySeeder extends Seeder
{

    public function run(): void
    {
        $specialties = [
            ['name' => 'Corte Clásico'],
            ['name' => 'Corte Moderno'],
            ['name' => 'Barba Tradicional'],
            ['name' => 'Barba Hipster'],
            ['name' => 'Afeitado'],
            ['name' => 'Fade'],
            ['name' => 'Undercut'],
            ['name' => 'Pompadour'],
            ['name' => 'Degradado'],
            ['name' => 'Corte Militar'],
            ['name' => 'Texturizado'],
            ['name' => 'Corte Largo'],
            ['name' => 'Styling'],
            ['name' => 'Tratamiento Capilar'],
            ['name' => 'Masaje Capilar'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
