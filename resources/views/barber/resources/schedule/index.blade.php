<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Horarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Acá se listarán los horarios del barbero") }}
                </div>

                <div style="padding: 20px;">
                    {{-- Mensaje de éxito --}}
                    @if (session('message'))
                        <p style="color: green; margin-bottom: 10px;">
                            {{ session('message') }}
                        </p>
                    @endif

                    {{-- Filtros --}}
                    <form method="GET" action="{{ route('barber.schedules.index') }}" style="margin-bottom: 20px;">
                        <label for="schedule_date">Fecha:</label>
                        <input type="date" id="schedule_date" name="schedule_date" value="{{ request('schedule_date') }}" style="margin-right: 10px;">

                        <label for="start_time">Hora inicio:</label>
                        <input type="time" id="start_time" name="start_time" value="{{ request('start_time') }}" style="margin-right: 10px;">

                        <label for="status">Estado:</label>
                        <select id="status" name="status" style="margin-right: 10px;">
                            <option value="">Todos</option>
                            <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Disponible</option>
                            <option value="booked" {{ request('status') === 'booked' ? 'selected' : '' }}>Reservado</option>
                        </select>

                        <button type="submit" style="margin-right: 10px;">Filtrar</button>
                        <a href="{{ route('barber.schedules.index') }}" style="color: #555;">Limpiar filtros</a>
                    </form>

                    {{-- Tabla de horarios --}}
                    @if ($schedules->isEmpty())
                        <p>No hay horarios registrados.</p>
                    @else
                        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                            <thead style="background-color: #f2f2f2;">
                                <tr>
                                    <th>Nombre</th>
                                    <th>ID</th>
                                    <th>Día</th>
                                    <th>Hora de Inicio</th>
                                    <th>Hora de Fin</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->name }}</td>
                                        <td>{{ $schedule->id }}</td>
                                        <td>{{ $schedule->date->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                        <td>
                                            <a href="{{ route('barber.schedules.show', $schedule->id) }}">Ver</a> |
                                            <a href="{{ route('barber.schedules.edit', $schedule->id) }}">Editar</a> |
                                            <form action="{{ route('barber.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Deseas eliminar este horario?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    {{-- Paginación --}}
                    <div style="margin-top: 20px;">
                        {{ $schedules->links() }}
                    </div>

                    {{-- Botón crear --}}
                    <div style="margin-top: 20px;">
                        <a href="{{ route('barber.schedules.create') }}">+ Crear nuevo horario</a>
                    </div>

                    {{-- FullCalendar --}}
                    <hr style="margin: 40px 0;">
                    <h3 style="font-weight: bold; margin-bottom: 10px;">Calendario de Horarios</h3>
                    <div id="calendar"></div>

                    {{-- FullCalendar scripts --}}
                    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
                    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

                    @php
                        $calendarEvents = $schedules->map(function ($s) {
                            return [
                                'title' => $s->name,
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
    </div>
</x-barber-app-layout>
