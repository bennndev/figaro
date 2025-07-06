<?php

namespace App\Services\Admin\Resources;

use App\Models\Schedule;
use App\Models\Barber;
use Illuminate\Http\Request;

class ScheduleService
{
    public function index(Request $request)
    {
        return Schedule::with('barber')
        ->when($request->barber_name, function ($query) use ($request) {
            $query->whereHas('barber', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->barber_name . '%')
                  ->orWhere('last_name', 'like', '%' . $request->barber_name . '%');
            });
        })
        ->when($request->date, fn($q) => $q->where('date', $request->date))
        ->latest()
        ->paginate(10);
    }

    public function store(array $data): Schedule
    {
        return Schedule::create($data);
    }

    public function update(Schedule $schedule, array $data): Schedule
    {
        $schedule->update($data);
        return $schedule;
    }

    public function destroy(Schedule $schedule): void
    {
        $schedule->delete();
    }

    public function getById(int $id): Schedule
    {
        return Schedule::with('barber')->findOrFail($id);
    }

    public function getAllBarbers()
    {
        return Barber::all();
    }

    public function getForCalendar(Request $request)
    {
        return Schedule::with('barber')
            ->when($request->barber_name, function ($query) use ($request) {
                $query->whereHas('barber', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->barber_name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->barber_name . '%');
                });
            })
            ->when($request->date, fn($q) => $q->where('date', $request->date))
            ->get();
    }
}
