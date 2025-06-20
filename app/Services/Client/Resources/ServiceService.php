<?php

namespace App\Services\Client\Resources;

use App\Models\Service;
use App\Models\Specialty;
class ServiceService
{
    public function returnAll()
    {
        $services = Service::all();
        return $services;
    }

    public function find($id)
    {
        $service = Service::findOrFail($id);
        return $service;
    }

    public function filter(array $filters)
    {
        $query = Service::query()->with('specialties');

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['specialty_id'])) {
            $query->whereHas('specialties', function ($q) use ($filters) {
                $q->where('specialties.id', $filters['specialty_id']);
            });
        }

        return $query->paginate(6);
    }

    public function getSpecialties()
    {
        return Specialty::all();
    }
}