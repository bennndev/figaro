<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;

use App\Models\Barber;
use App\Services\Admin\Resources\BarberService;

use App\Http\Requests\Admin\Resources\Barber\CreateBarberRequest;
use App\Http\Requests\Admin\Resources\Barber\UpdateBarberRequest;
use App\Http\Requests\Admin\Resources\Barber\FilterBarberRequest;

class BarberController extends Controller
{
    public function __construct(protected BarberService $service)
    {
    }

    public function index(FilterBarberRequest $request)
    {
        $filters = $request->validated();
        $barbers = $this->service->filter($filters);
        $specialties = $this->service->getSpecialties();

        return view('admin.resources.barber.index', compact('barbers', 'filters', 'specialties'));
    }

    public function create()
    {
        $specialties = $this->service->getSpecialties();
        return view('admin.resources.barber.form', ['barber' => new Barber(), 'specialties' => $specialties]);
    }

    public function store(CreateBarberRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.barbers.index')
            ->with('message', 'Barbero creado correctamente');
    }

    public function show(int $id)
    {
        $barber = $this->service->find($id);
        return view('admin.resources.barber.show', compact('barber'));
    }

    public function edit(int $id)
    {
        $barber = $this->service->find($id);
        $specialties = $this->service->getSpecialties();

        return view('admin.resources.barber.update', compact('barber', 'specialties'));
    }

    public function update(UpdateBarberRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());

        return redirect()->route('admin.barbers.index')
            ->with('message', 'Barbero actualizado exitosamente');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()->route('admin.barbers.index')
            ->with('message', 'Barbero eliminado exitosamente');
    }
}
