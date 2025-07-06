<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Barber;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $barbers = Barber::all();
        $scheduleTypes = [
            'Turno Mañana',
            'Turno Tarde', 
            'Turno Completo',
            'Horario Especial',
            'Fin de Semana'
        ];

        foreach ($barbers as $index => $barber) {
            // Crear 15 horarios por barbero distribuidos en diferentes fechas
            for ($i = 0; $i < 15; $i++) {
                $date = Carbon::now()->addDays($i % 30); // Distribuir en 30 días
                $scheduleType = $scheduleTypes[$i % count($scheduleTypes)];
                
                // Definir horarios según el tipo
                switch ($scheduleType) {
                    case 'Turno Mañana':
                        $startTime = '09:00:00';
                        $endTime = '14:00:00';
                        break;
                    case 'Turno Tarde':
                        $startTime = '15:00:00';
                        $endTime = '20:00:00';
                        break;
                    case 'Turno Completo':
                        $startTime = '09:00:00';
                        $endTime = '20:00:00';
                        break;
                    case 'Horario Especial':
                        $startTime = '10:00:00';
                        $endTime = '18:00:00';
                        break;
                    case 'Fin de Semana':
                        $startTime = '10:00:00';
                        $endTime = '16:00:00';
                        break;
                }

                Schedule::create([
                    'barber_id' => $barber->id,
                    'name' => $scheduleType,
                    'date' => $date->format('Y-m-d'),
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                ]);
            }
        }
    }
}
