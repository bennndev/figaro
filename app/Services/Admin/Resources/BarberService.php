<?php

namespace App\Services\Admin\Resources;

use App\Models\Barber;
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
        $query = Barber::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $query->get();
    }

    /**
     * Buscar un barbero por su ID.
     */
    public function find(int $id): Barber
    {
        return Barber::findOrFail($id);
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

        return Barber::create($data);
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

        return $barber->update($data);
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
}
