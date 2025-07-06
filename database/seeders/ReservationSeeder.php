<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Barber;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $barbers = Barber::all();
        $statuses = ['pending_pay', 'paid', 'cancelled', 'completed'];

        $notes = [
            'Quiero un corte moderno para una entrevista de trabajo',
            'Por favor, arreglo de barba muy detallado',
            'Es mi primera vez, necesito asesoramiento',
            'Corte similar al que me hiciste la vez pasada',
            'Tengo el cabello muy rizado, necesito algo especial',
            'Quiero cambiar completamente de look',
            'Solo un retoque rápido por favor',
            'Preparación para una boda este fin de semana',
            'Corte infantil, mi hijo es muy tímido',
            'Necesito algo profesional para el trabajo',
            'Quiero probar algo más atrevido',
            'Por favor con mucha paciencia, soy mayor',
            'Corte para evento especial mañana',
            'Mantener el estilo actual pero más corto',
            null, // Algunas reservas sin nota
        ];

        for ($i = 0; $i < 15; $i++) {
            $reservationDate = Carbon::now()->addDays(rand(-30, 60)); // Reservas pasadas y futuras
            $reservationTime = sprintf('%02d:%02d:00', rand(9, 19), [0, 15, 30, 45][rand(0, 3)]);
            
            Reservation::create([
                'user_id' => $users->random()->id,
                'barber_id' => $barbers->random()->id,
                'reservation_date' => $reservationDate->format('Y-m-d'),
                'reservation_time' => $reservationTime,
                'note' => $notes[$i],
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
