<?php

namespace App\Services\Client\Resources;

use App\Models\Barber;
use App\Models\Specialty;
use App\Models\Schedule;

class BarberService
{
    public function returnAll()
    {
        return Barber::all();
    }

    public function find(int $id): Barber
    {
        return Barber::findOrFail($id);
    }

    public function filter(array $filters)
    {
        $query = Barber::query()->with('specialties');

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['last_name'])) {
            $query->where('last_name', 'like', '%' . $filters['last_name'] . '%');
        }

        if (!empty($filters['specialty_id'])) {
            $query->whereHas('specialties', function ($q) use ($filters) {
                $q->where('specialties.id', $filters['specialty_id']);
            });
        }

        return $query->paginate(6);
    }

    public function getSpecialties(){
        return Specialty::all();
    }

    public function getSchedulesByDate(int $barberId, string $date)
    {
        return Schedule::where('barber_id', $barberId)
            ->where('date', $date)
            ->orderBy('start_time')
            ->get(['id', 'start_time', 'end_time']);
    }
}