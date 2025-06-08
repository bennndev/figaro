<?php

namespace App\Services\Admin\Resources;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceService
{
    /**
     * Obtener todos los servicios.
     */
    public function returnAll()
    {
        return Service::all();
    }

    /**
     * Filtrar servicios según los criterios indicados.
     */
    public function filter(array $filters)
    {
        $query = Service::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $query->get();
    }

    /**
     * Buscar un servicio por ID.
     */
    public function find(int $id): Service
    {
        return Service::findOrFail($id);
    }

    /**
     * Crear un nuevo servicio.
     */
    public function create(array $data): Service
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('services/images', 'public');
        }

        return Service::create($data);
    }

    /**
     * Actualizar un servicio existente.
     */
    public function update(int $id, array $data): bool
    {
        $service = $this->find($id);

        if (isset($data['image'])) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $data['image'] = $data['image']->store('services/images', 'public');
        }

        return $service->update($data);
    }

    /**
     * Eliminar un servicio.
     */
    public function delete(int $id): bool
    {
        $service = $this->find($id);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        return $service->delete();
    }
}
