<?php

namespace App\Services\Client\Resources;

use App\Models\Barber;

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
}