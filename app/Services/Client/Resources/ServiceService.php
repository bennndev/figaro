<?php

namespace App\Services\Client\Resources;

use App\Models\Service;

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
}