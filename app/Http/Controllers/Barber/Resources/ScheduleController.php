<?php

namespace App\Http\Controllers\Barber\Resources;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Services\Barber\Resources\ScheduleService;

use App\Http\Requests\Barber\Resources\Schedule\CreateScheduleRequest;
use App\Http\Requests\Barber\Resources\Schedule\UpdateScheduleRequest;
use App\Http\Requests\Barber\Resources\Schedule\FilterScheduleRequest;

class ScheduleController extends Controller
{
    public function __construct(protected ScheduleService $service)
    {
    }

    public function index(FilterScheduleRequest $request)
    {
        $filters = $request->validated();
        $schedules = $this->service->filter($filters);

        return view('barber.resources.schedule.index', compact('schedules', 'filters'));
    }

    public function create()
    {
        return view('barber.resources.schedule.form', [
            'schedule' => new Schedule(),
        ]);
    }

    public function store(CreateScheduleRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('barber.schedules.index')
            ->with('message', 'Horario creado correctamente');
    }

    public function show(int $id)
    {
        $schedule = $this->service->find($id);
        return view('barber.resources.schedule.show', compact('schedule'));
    }

    public function edit(int $id)
    {
        $schedule = $this->service->find($id);
        return view('barber.resources.schedule.edit', compact('schedule'));
    }

    public function update(UpdateScheduleRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());

        return redirect()->route('barber.schedules.index')
            ->with('message', 'Horario actualizado exitosamente');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()->route('barber.schedules.index')
            ->with('message', 'Horario eliminado exitosamente');
    }
}
