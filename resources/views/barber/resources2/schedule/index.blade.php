<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Horarios
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" shadow-sm sm:rounded-lg text-white p-6">

                {{-- Mensaje de éxito --}}
                @if (session('message'))
                    <p class="text-green-400 mb-4">
                        {{ session('message') }}
                    </p>
                @endif

                {{-- Filtros --}}
                <form method="GET" action="{{ route('barber.schedules.index') }}" class="mb-6 flex flex-wrap gap-6 items-end">
                    {{-- Fecha --}}
                    <div class="flex flex-col">
                        <label for="schedule_date" class="mb-1 text-sm">Fecha</label>
                        <input type="date" id="schedule_date" name="schedule_date"
                            value="{{ request('schedule_date') }}"
                            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
                    </div>

                    {{-- Hora Inicio --}}
                    <div class="flex flex-col">
                        <label for="start_time" class="mb-1 text-sm">Hora inicio</label>
                        <input type="time" id="start_time" name="start_time"
                            value="{{ request('start_time') }}"
                            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
                    </div>

                    {{-- Estado --}}
                    <div class="flex flex-col">
                        <label for="status" class="mb-1 text-sm">Estado</label>
                        <select id="status" name="status"
                            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500">
                            <option value="">Todos</option>
                            <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Disponible</option>
                            <option value="booked" {{ request('status') === 'booked' ? 'selected' : '' }}>Reservado</option>
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="flex gap-2 mt-4">
                        <button type="submit"
                            class="bg-white text-black font-semibold rounded-md px-4 py-2 hover:bg-white/80 transition">
                            <i class="bi bi-funnel-fill"></i> Filtrar
                        </button>
                        <a href="{{ route('barber.schedules.index') }}"
                            class="bg-white text-black font-semibold rounded-md px-4 py-2 hover:bg-white/80 transition">
                            Limpiar
                        </a>
                    </div>
                </form>

                {{-- Tabla --}}
                @if ($schedules->isEmpty())
                    <p class="text-white">No hay horarios registrados.</p>
                @else
                    <div class="overflow-x-auto rounded-xl border border-gray-700">
                        <table class="w-full text-left border-separate border-spacing-y-1 bg-[#1E1E1E] text-white">
                            <thead class="bg-[#2A2A2A] text-white">
                                <tr>
                                    <th class="px-4 py-2">Nombre</th>
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Día</th>
                                    <th class="px-4 py-2">Hora de Inicio</th>
                                    <th class="px-4 py-2">Hora de Fin</th>
                                    <th class="px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    <tr class="hover:bg-white/10 transition">
                                        <td class="px-4 py-2">{{ $schedule->name }}</td>
                                        <td class="px-4 py-2">{{ $schedule->id }}</td>
                                        <td class="px-4 py-2">{{ $schedule->date->format('Y-m-d') }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">
    <div class="flex justify-start items-center space-x-3">
        {{-- Ver --}}
        <x-barber.modal-show-schedule :schedule="$schedule" />

        {{-- Editar --}}
        <x-barber.edit :schedule="$schedule" />

        {{-- Eliminar --}}
        <form method="POST" action="{{ route('barber.schedules.destroy', $schedule->id) }}" class="delete-form">
    @csrf
    @method('DELETE')
    <button type="submit"
        class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 bg-transparent border-none p-0"
        title="Eliminar">
        <i class="bi bi-trash-fill"></i>
    </button>
</form>

    </div>
</td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                {{-- Paginación --}}
                <div class="mt-6">
                    {{ $schedules->links() }}
                </div>

                {{-- Botón crear --}}
                <div class="mt-6 flex justify-end">
                    <x-barber.create />

                </div>

                {{-- FullCalendar --}}
                <hr class="my-10 border-white/20">
                <h3 class="text-xl font-semibold mb-4">Calendario de Horarios</h3>
                <div id="calendar" class="bg-white rounded shadow"></div>

                {{-- FullCalendar Scripts --}}
                <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
                <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

                @php
                    $calendarEvents = $schedules->map(function ($s) {
                        return [
                            'title' => $s->name,
                            'start' => $s->date->format('Y-m-d') . 'T' . $s->start_time,
                            'end' => $s->date->format('Y-m-d') . 'T' . $s->end_time,
                            'color' => $s->status === 'available' ? '#3B82F6' : '#DC2626',
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

                    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.delete-form');

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
                </script>

                <style>
                    #calendar {
                        background-color: #2A2A2A;
                        color: white;
                        padding: 1rem;
                        border-radius: 0.5rem;
                    }

                    .fc .fc-daygrid-day-number,
                    .fc .fc-col-header-cell-cushion,
                    .fc-toolbar-title {
                        color: white;
                    }

                    .fc-button {
                        background-color: #1F1F1F !important;
                        color: white !important;
                        border: 1px solid #444 !important;
                    }

                    .fc-button:hover {
                        background-color: #3B3B3B !important;
                    }

                    .fc-daygrid-day:hover {
                        background-color: rgba(255, 255, 255, 0.05);
                    }

                    .fc-event {
                        border: none;
                        font-weight: 500;
                    }

                    .fc .fc-scrollgrid-section-header td {
                        background-color: #1F1F1F;
                    }

                    .fc-theme-standard td,
                    .fc-theme-standard th {
                        border: 1px solid #3B3B3B;
                    }
                </style>

            </div>
        </div>
    </div>
</x-barber-app-layout>
