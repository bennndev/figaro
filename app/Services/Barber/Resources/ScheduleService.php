<?php

namespace App\Services\Barber\Resources;

use App\Models\Schedule;

class ScheduleService
{
    public function returnAllForBarber(): \Illuminate\Support\Collection
    {
        return Schedule::where('barber_id', auth('barber')->id())->get();
    }

    public function filter(array $filters)
    {
        $query = Schedule::where('barber_id', auth('barber')->id());

        if (!empty($filters['schedule_date'])) {
            $query->whereDate('schedule_date', $filters['schedule_date']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['start_time'])) {
            $query->whereTime('start_time', $filters['start_time']);
        }

        return $query->paginate(10); 
    }

    public function find(int $id): Schedule
    {
        return Schedule::where('id', $id)
                       ->where('barber_id', auth('barber')->id())
                       ->firstOrFail();
    }

    public function create(array $data): Schedule
    {
        $data['barber_id'] = auth('barber')->id();
        return Schedule::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $schedule = $this->find($id);
        return $schedule->update($data);
    }

    public function delete(int $id): bool
    {
        $schedule = $this->find($id);
        return $schedule->delete();
    }

    public function all()
    {
        return Schedule::where('barber_id', auth('barber')->id())->get();
    }
}
