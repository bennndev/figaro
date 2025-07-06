<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Horario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 shadow-sm rounded">
            <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 20px;">
                    <label for="barber_id">Barbero:</label>
                    <select name="barber_id" id="barber_id" required>
                        @foreach ($barbers as $barber)
                            <option value="{{ $barber->id }}" {{ $schedule->barber_id == $barber->id ? 'selected' : '' }}>
                                {{ $barber->first_name }} {{ $barber->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="name">Nombre del horario:</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $schedule->name) }}" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="date">Fecha:</label>
                    <input type="date" name="date" id="date" value="{{ old('date', $schedule->date->format('Y-m-d')) }}" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="start_time">Hora de inicio:</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $schedule->start_time) }}" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="end_time">Hora de fin:</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $schedule->end_time) }}" required>
                </div>

                <button type="submit" style="background-color: blue; color: white; padding: 10px 20px; border-radius: 5px;">
                    Actualizar
                </button>
                <a href="{{ route('admin.schedules.index') }}" style="margin-left: 10px;">Cancelar</a>
            </form>
        </div>
    </div>
</x-admin-app-layout>
