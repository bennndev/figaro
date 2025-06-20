<?php

namespace App\Services\Client\Resources;

use App\Models\Barber;
use App\Http\Requests\Client\Resources\Barber\FilterBarberRequest;
use App\Models\Specialty;

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

        return $query->paginate(10);
    }

    public function getSpecialties(){
        return Specialty::all();
    }
}