<?php

namespace App\Http\Controllers\Admin\Resources;

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Resources\Schedule\CreateScheduleRequest;
use App\Http\Requests\Admin\Resources\Schedule\UpdateScheduleRequest;
use App\Http\Requests\Admin\Resources\Schedule\FilterScheduleRequest;

use App\Models\Schedule;
use App\Services\Admin\Resources\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct(protected ScheduleService $service)
    {
    }

  public function index(FilterScheduleRequest $request)
    {
        $schedules = $this->service->index($request); // paginado para la tabla
        $barbers = $this->service->getAllBarbers();
        $calendarSchedules = $this->service->getForCalendar($request); // para el calendario

        return view('admin.resources2.schedule.index', compact('schedules', 'barbers', 'calendarSchedules'));
    }

    public function create()
    {
        $barbers = $this->service->getAllBarbers();
        return view('admin.resources2.schedule.create', compact('barbers'));
    }

    public function store(CreateScheduleRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.schedules.index')->with('message', 'Horario creado correctamente.');
    }

    public function show(int $id)
    {
        $schedule = $this->service->getById($id);
        return view('admin.resources.schedule.show', compact('schedule'));
    }

    public function edit(int $id)
    {
        $schedule = $this->service->getById($id);
        $barbers = $this->service->getAllBarbers();
        return view('admin.resources2.schedule.edit', compact('schedule', 'barbers'));
    }

    public function update(UpdateScheduleRequest $request, int $id)
    {
        $schedule = $this->service->getById($id);
        $this->service->update($schedule, $request->validated());
        return redirect()->route('admin.schedules.index')->with('message', 'Horario actualizado correctamente.');
    }

    public function destroy(int $id)
    {
        $schedule = $this->service->getById($id);
        $this->service->destroy($schedule);
        return redirect()->route('admin.schedules.index')->with('message', 'Horario eliminado correctamente.');
    }
}
