<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Primero creamos las entidades principales
        $this->call(AdminSeeder::class);
        $this->call(SpecialtySeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(BarberSeeder::class);
        
        // Crear usuarios con factory
        User::factory(15)->create();
        
        // Seeders que dependen de las entidades principales
        $this->call(ScheduleSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(PaymentSeeder::class);
        
        // Seeders de relaciones many-to-many (tablas pivot)
        $this->call(ServiceSpecialtySeeder::class);
        $this->call(BarberSpecialtySeeder::class);
        
        // Relaciones que dependen de reservaciones (deben ir al final)
        $this->call(ReservationServiceSeeder::class);
        $this->call(ReservationSpecialtySeeder::class);
    }
}
