<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Horarios de los Barberos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Mensaje de éxito --}}
                @if (session('message'))
                    <p style="color: green; margin-bottom: 15px;">
                        {{ session('message') }}
                    </p>
                @endif

                {{-- Filtros --}}
                <form method="GET" action="{{ route('admin.schedules.index') }}" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                    {{-- Buscar por nombre de barbero --}}
                    <div>
                        <label for="barber_name">Barbero:</label>
                        <input type="text" name="barber_name" id="barber_name" value="{{ request('barber_name') }}" placeholder="Nombre o apellido del barbero">
                    </div>


                    {{-- Fecha --}}
                    <div>
                        <label for="date">Fecha:</label>
                        <input type="date" name="date" id="date" value="{{ request('date') }}">
                    </div>

                    {{-- Estado --}}
                    <div>
                        <label for="status">Estado:</label>
                        <select name="status" id="status">
                            <option value="">Todos</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                            <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Reservado</option>
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div>
                        <button type="submit" style="margin-right: 10px;">Filtrar</button>
                        <a href="{{ route('admin.schedules.index') }}" style="color: #555;">Limpiar</a>
                    </div>
                </form>


                {{-- Tabla --}}
                @if ($schedules->isEmpty())
                    <p>No hay horarios registrados.</p>
                @else
                    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                        <thead style="background-color: #f2f2f2;">
                            <tr>
                                <th>ID</th>
                                <th>Barbero</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Hora Inicio</th>
                                <th>Hora Fin</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->id }}</td>
                                    <td>{{ $schedule->barber->first_name }} {{ $schedule->barber->last_name }}</td>
                                    <td>{{ $schedule->name }}</td>
                                    <td>{{ $schedule->date->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                    <td>{{ ucfirst($schedule->status) }}</td>
                                    <td>
                                        <a href="{{ route('admin.schedules.show', $schedule->id) }}">Ver</a> |
                                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}">Editar</a> |
                                        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este horario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Paginación --}}
                    <div style="margin-top: 20px;">
                        {{ $schedules->links() }}
                    </div>
                @endif

                {{-- Botón crear --}}
                <div style="margin-top: 20px;">
                    <a href="{{ route('admin.schedules.create') }}">+ Crear nuevo horario</a>
                </div>

                {{-- FullCalendar --}}
                <hr style="margin: 40px 0;">
                <h3 style="font-weight: bold; margin-bottom: 10px;">Calendario de Horarios</h3>
                <div id="calendar"></div>

                {{-- FullCalendar Scripts --}}
                <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
                <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

                @php
                    $calendarEvents = $calendarSchedules->map(function ($s) {
                        return [
                            'title' => "{$s->name} - {$s->barber->name}",
                            'start' => $s->date->format('Y-m-d') . 'T' . $s->start_time,
                            'end' => $s->date->format('Y-m-d') . 'T' . $s->end_time,
                            'color' => $s->status === 'available' ? 'blue' : 'red',
                        ];
                    });
                @endphp

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        let calendarEl = document.getElementById('calendar');
                        let calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            locale: 'es',
                            height: 650,
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            events: @json($calendarEvents)
                        });
                        calendar.render();
                    });
                </script>

            </div>
        </div>
    </div>
</x-admin-app-layout>
