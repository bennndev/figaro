<?php

namespace App\Services\Admin\Resources;

use App\Models\Specialty;

class SpecialtyService
{

    public function returnAll()
    {
        return Specialty::all();
    }

    public function find(int $id): Specialty
    {
        return Specialty::findOrFail($id);
    }

    # Busqueda por filtros
    public function filter(array $filters)
    {
        $query = Specialty::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $query->get();
    }

    public function create(array $data): Specialty
    {
        return Specialty::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return Specialty::where('id', $id)->update($data);
    }

    public function delete(int $id):bool
    {
        return Specialty::where('id', $id)->delete();
    }
}