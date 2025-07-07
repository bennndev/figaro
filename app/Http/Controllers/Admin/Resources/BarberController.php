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

        return view('admin.resources2.barber.index', compact('barbers', 'filters', 'specialties'));
    }

    public function create()
    {
        $specialties = $this->service->getSpecialties();
        return view('admin.resources2.barber.form', ['barber' => new Barber(), 'specialties' => $specialties]);
    }

    public function store(CreateBarberRequest $request)
    {
        try {
            $barber = $this->service->create($request->validated());
            return redirect()->route('admin.barbers.index')
                ->with('success', 'Barbero creado correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al crear el barbero: ' . $e->getMessage()])
                ->withInput()
                ->with('modal_context', 'create_barber');
        }
    }

    public function show(int $id)
    {
        $barber = $this->service->find($id);
        return view('admin.resources2.barber.show', compact('barber'));
    }

    public function edit(int $id)
    {
        $barber = $this->service->find($id);
        $specialties = $this->service->getSpecialties();

        return view('admin.resources2.barber.update', compact('barber', 'specialties'));
    }

    public function update(UpdateBarberRequest $request, int $id)
    {
        try {
            $this->service->update($id, $request->validated());
            return redirect()->route('admin.barbers.index')
                ->with('success', 'Barbero actualizado correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar el barbero: ' . $e->getMessage()])
                ->withInput()
                ->with('modal_context', 'edit_barber');
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.barbers.index')
                ->with('success', 'Barbero eliminado correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar el barbero: ' . $e->getMessage()]);
        }
    }
}
