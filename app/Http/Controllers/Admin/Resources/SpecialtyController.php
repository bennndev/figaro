<?php

namespace App\Http\Controllers\Admin\Resources;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Specialty;
use App\Services\Admin\Resources\SpecialtyService;

use App\Http\Requests\Admin\Resources\Specialty\CreateSpecialtyRequest;
use App\Http\Requests\Admin\Resources\Specialty\UpdateSpecialtyRequest;
use App\Http\Requests\Admin\Resources\Specialty\FilterSpecialtyRequest;


class SpecialtyController extends Controller
{

    public function __construct(protected SpecialtyService $service)
    {
        
    }

    public function index(FilterSpecialtyRequest $request)
    {

        $filters = $request->validated();
        $specialties = $this->service->filter($filters);

        return view('admin.resources2.specialty.index', compact('specialties', 'filters'));
    }

    public function create()
    {
        return view('admin.resources2.specialty.form', [ 'specialty' => new Specialty() ]);
    }

    public function store(CreateSpecialtyRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.specialties.index')->with('message', 'Especialidad creada correctamente');
    }

    public function show(int $id)
    {

        $specialty = $this->service->find($id);
        return view('admin.resources2.specialty.show', compact('specialty'));
    }

    public function edit(int $id)
    {
        $specialty = $this->service->find($id);

        return view('admin.resources2.specialty.update', compact('specialty'));
    }

    public function update(UpdateSpecialtyRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());

        return redirect()->route('admin.specialties.index')->with('message', 'Especialidad actualizada exitosamente');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()->route('admin.specialties.index')->with('message', 'Especialidad eliminada exitosamente');
    }
}

