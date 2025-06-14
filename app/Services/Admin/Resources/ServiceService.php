<?php

namespace App\Services\Admin\Resources;

use App\Models\Service;
use App\Models\Specialty;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class ServiceService
{
    public function returnAll()
    {
        return Service::with('specialties')->get(); // Carga las relaciones también
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

        return $query->paginate(9);
    }

    public function find(int $id): Service
    {
        return Service::with('specialties')->findOrFail($id);
    }

    public function create(array $data): Service
    {
        $specialties = $data['specialties'] ?? [];
        unset($data['specialties']); // Evitar error al guardar

        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('services/images', 'public');
        }

        $service = Service::create($data);

        // Asociar especialidades
        $service->specialties()->attach($specialties);

        return $service;
    }

    public function update(int $id, array $data): bool
    {
        $service = $this->find($id);

        $specialties = $data['specialties'] ?? null;
        unset($data['specialties']); // Evitar error

        if (isset($data['image'])) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $data['image'] = $data['image']->store('services/images', 'public');
        }

        $updated = $service->update($data);

        // Solo sincronizar si se enviaron especialidades
        if (isset($specialties)) {
            $service->specialties()->sync($specialties);
        }       

        return $updated;
    }

    public function delete(int $id): bool
    {
        $service = $this->find($id);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        // También elimina relaciones con specialties (por cascada o detach)
        $service->specialties()->detach();

        return $service->delete();
    }

    # Obtener las especialidades
    public function getSpecialties(): Collection
    {
        return Specialty::all();
    }
}
