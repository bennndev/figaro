<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;

use App\Models\Service;
use App\Models\Specialty;
use App\Services\Admin\Resources\ServiceService;

use App\Http\Requests\Admin\Resources\Service\CreateServiceRequest;
use App\Http\Requests\Admin\Resources\Service\UpdateServiceRequest;
use App\Http\Requests\Admin\Resources\Service\FilterServiceRequest;

class ServiceController extends Controller
{
    public function __construct(protected ServiceService $service)
    {
    }

    public function index(FilterServiceRequest $request)
    {
        $filters = $request->validated();
        $services = $this->service->filter($filters);
        $specialties = $this->service->getSpecialties();	

        return view('admin.resources.service.index', compact('services', 'filters', 'specialties'));
    }

    public function create()
    {
        $specialties = $this->service->getSpecialties();
        return view('admin.resources.service.form', [
            'service' => new Service(),
            'specialties' => $specialties,
        ]);
    }

    public function store(CreateServiceRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.services.index')
            ->with('message', 'Servicio creado correctamente');
    }

    public function show(int $id)
    {
        $service = $this->service->find($id);
        return view('admin.resources.service.show', compact('service'));
    }

    public function edit(int $id)
    {   
        $specialties = $this->service->getSpecialties();
        $service = $this->service->find($id);
        return view('admin.resources.service.update', compact('service', 'specialties'));
    }

    public function update(UpdateServiceRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());

        return redirect()->route('admin.services.index')
            ->with('message', 'Servicio actualizado exitosamente');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()->route('admin.services.index')
            ->with('message', 'Servicio eliminado exitosamente');
    }
}
