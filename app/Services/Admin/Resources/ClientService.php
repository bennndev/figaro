<?php

namespace App\Services\Admin\Resources;

use App\Models\User;

class ClientService
{
    public function returnAll()
    {
        return User::all();
    }

    public function find(int $id): User
    {
        return User::findOrFail($id);
    }

    # Busqueda por filtros
    public function filter(array $filters)
    {
        $query = User::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['last_name'])) {
            $query->where('last_name', 'like', '%' . $filters['last_name'] . '%');
        }

        return $query->get();
    }

    // public function create(array $data): User
    // {
    //     return User::create($data);
    // }

    // public function update(int $id, array $data): bool
    // {
    //     return User::where('id', $id)->update($data);
    // }

    // public function delete(int $id):bool
    // {
    //     return User::where('id', $id)->delete();
    // }
}