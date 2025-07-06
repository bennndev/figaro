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
            ['name' => 'Corte Degradado'],
            ['name' => 'Ondulado'],
            ['name' => 'Afeitado'],
            ['name' => 'Decoloración'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
