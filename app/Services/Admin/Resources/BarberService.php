<?php

namespace App\Services\Admin\Resources;

use App\Models\Barber;
use App\Models\Specialty;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BarberService
{
    /**
     * Obtener todos los barberos.
     */
    public function index()
    {
        return Barber::all();
    }

    /**
     * Filtrar barberos según los criterios indicados.
     */
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

    /**
     * Buscar un barbero por su ID.
     */
    public function find(int $id): Barber
    {
        return Barber::with('specialties')->findOrFail($id);
    }

    /**
     * Crear un nuevo barbero.
     */
    public function create(array $data): Barber
    {
        if (isset($data['profile_photo'])) {
            $data['profile_photo'] = $data['profile_photo']->store('barbers/profile_photos', 'public');
        }

        $data['password'] = Hash::make($data['password']);

        $barber = Barber::create($data);

        if (isset($data['specialty_ids'])) {
            $barber->specialties()->attach($data['specialty_ids']);
        }

        return $barber;
    }

    /**
     * Actualizar un barbero existente.
     */
    public function update(int $id, array $data): bool
    {
        $barber = $this->find($id);

        if (isset($data['profile_photo'])) {
            if ($barber->profile_photo) {
                Storage::disk('public')->delete($barber->profile_photo);
            }

            $data['profile_photo'] = $data['profile_photo']->store('barbers/profile_photos', 'public');
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $updated = $barber->update($data);

        if (isset($data['specialty_ids'])) {
            $barber->specialties()->sync($data['specialty_ids']);
        }

        return $updated;
    }

    /**
     * Eliminar un barbero.
     */
    public function delete(int $id): bool
    {
        $barber = $this->find($id);

        if ($barber->profile_photo) {
            Storage::disk('public')->delete($barber->profile_photo);
        }

        return $barber->delete();
    }

    public function getSpecialties()
    {
        return Specialty::all();
    }
}
