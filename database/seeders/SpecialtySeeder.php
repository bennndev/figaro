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
        Specialty::create(['name' => 'Corte']);
        Specialty::create(['name' => 'Barba']);
    }
}
