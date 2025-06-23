<?php

namespace App\Services\Admin\Resources;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function filter(array $filters)
    {
        $query = User::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['last_name'])) {
            $query->where('last_name', 'like', '%' . $filters['last_name'] . '%');
        }

        return $query->paginate(10);
    }

    public function create(array $data): User
    {
        if (isset($data['profile_photo'])) {
            $data['profile_photo'] = $data['profile_photo']->store('profiles', 'public');
        }

        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $client = User::findOrFail($id);

        if (isset($data['profile_photo'])) {
            if ($client->profile_photo && Storage::disk('public')->exists($client->profile_photo)) {
                Storage::disk('public')->delete($client->profile_photo);
            }

            $data['profile_photo'] = $data['profile_photo']->store('profiles', 'public');
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $client->update($data);
    }

    public function delete(int $id): bool
    {
        $client = User::findOrFail($id);

        if ($client->profile_photo && Storage::disk('public')->exists($client->profile_photo)) {
            Storage::disk('public')->delete($client->profile_photo);
        }

        return $client->delete();
    }
}
