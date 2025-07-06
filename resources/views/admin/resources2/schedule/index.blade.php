<x-admin-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
        <span>Horarios de los Barberos</span>
        <span class="mx-2 text-white">/</span>
        <a href="{{ route('admin.dashboard') }}" class="text-[#FFFFFF]  flex items-center">
            
            <span>Inicio</span>
        </a>
    </h2>
</x-slot>

    <div class="py-12  min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" shadow-sm sm:rounded-lg p-6  text-white">

                {{-- Mensaje de éxito --}}
                @if (session('message'))
                    <p class="text-green-400 mb-4">
                        {{ session('message') }}
                    </p>
                @endif

                {{-- Filtros --}}
                <form method="GET" action="{{ route('admin.schedules.index') }}" class="mb-6 flex flex-wrap gap-6 items-end">

    {{-- Barbero --}}
    <div class="flex flex-col">
        <label for="barber_name" class="mb-1 text-sm text-white">Barbero</label>
        <input type="text" name="barber_name" id="barber_name"
            value="{{ request('barber_name') }}"
            placeholder="Nombre o apellido del barbero"
            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
    </div>

    {{-- Fecha --}}
    <div class="flex flex-col">
        <label for="date" class="mb-1 text-sm text-white">Fecha</label>
        <input type="date" name="date" id="date"
            value="{{ request('date') }}"
            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
    </div>

    {{-- Botones --}}
    <div class="flex gap-2 mt-4">
        <button type="submit"
            class="bg-white text-[#2A2A2A] font-semibold rounded-md px-4 py-2 hover:bg-white/80 transition flex items-center gap-2">
            <i class="bi bi-funnel-fill"></i>
            
        </button>

        <a href="{{ route('admin.schedules.index') }}"
            class="bg-white text-[#2A2A2A] font-semibold rounded-md px-4 py-2 hover:bg-white/80 transition flex items-center gap-2">
            
            <span>Limpiar</span>
        </a>
    </div>

</form>


                {{-- Tabla --}}
                @if ($schedules->isEmpty())
    <p class="text-center text-gray-400 min-h-[200px]">No hay horarios registrados.</p>
@else
    <x-admin.table>
        <x-slot name="head">
            <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Barbero</th>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Fecha</th>
                <th class="px-4 py-3">Hora Inicio</th>
                <th class="px-4 py-3">Hora Fin</th>
                <th class="px-4 py-3">Acciones</th>
            </tr>
        </x-slot>

        @foreach ($schedules as $schedule)
            <tr class="hover:bg-[#FFFFFF]/20">
                <td class="px-4 py-2">{{ $schedule->id }}</td>
                <td class="px-4 py-2">{{ $schedule->barber->first_name }} {{ $schedule->barber->last_name }}</td>
                <td class="px-4 py-2">{{ $schedule->name }}</td>
                <td class="px-4 py-2">{{ $schedule->date->format('Y-m-d') }}</td>
                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                <td class="px-4 py-2 whitespace-nowrap">
                    <div class="flex items-center space-x-3">
                        {{-- Ver --}}
                        <button 
    type="button"
    @click="$dispatch('open-modal-show-schedule-{{ $schedule->id }}')" 
    title="Ver"
    class="text-white hover:text-white/70 transition"
>
    <i class="bi bi-eye-fill"></i>
</button>


                        {{-- Editar --}}
                        <button @click="$dispatch('open-modal-edit-schedule-{{ $schedule->id }}')" title="Editar"
    class="text-white hover:text-white/70 transition">
    <i class="bi bi-pencil-fill"></i>
</button>


                        {{-- Eliminar --}}
                        <form method="POST" action="{{ route('admin.schedules.destroy', $schedule->id) }}"
                            class="inline delete-form"
                            onsubmit="return confirm('¿Estás seguro de eliminar este horario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Eliminar"
                                class="text-white hover:text-white/70 transition">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-admin.table>

        {{-- Render de los Modales FUERA de la tabla --}}
    @foreach ($schedules as $schedule)
        <x-admin.modal-show-schedule :schedule="$schedule" />
        <x-admin.modal-edit-schedule :schedule="$schedule" :barbers="$barbers" />
    @endforeach
@endif {{-- ESTE CIERRA el @if ($schedules->isEmpty()) correctamente --}}

{{-- Paginación --}}
<div class="mt-6">
    {{ $schedules->links() }}
</div>
                {{-- Botón crear --}}
                <div class="mt-6 flex justify-end">
    <div x-data="{ showScheduleModal: false }">

    {{-- Botón para abrir modal --}}
    <button 
        @click="showScheduleModal = true"
        class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition"
    >
        <i class="bi bi-plus-lg"></i> Nuevo horario
    </button>

    {{-- Componente del modal --}}
    <x-admin.schedule-create :barbers="$barbers" />

</div>

</div>


                {{-- FullCalendar --}}
                <hr class="my-10 border-white/20">
                <h3 class="text-xl font-semibold mb-4">Calendario de Horarios</h3>
                <div id="calendar" class="bg-white rounded shadow"></div>

                {{-- FullCalendar Scripts --}}
                <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
                <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

                @php
                    $calendarEvents = $calendarSchedules->map(function ($s) {
                        return [
                            'title' => "{$s->name} - {$s->barber->name}",
                            'start' => $s->date->format('Y-m-d') . 'T' . $s->start_time,
                            'end' => $s->date->format('Y-m-d') . 'T' . $s->end_time,
                            'color' => '#3B82F6',
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
                <style>
    /* Estilo general del calendario */
    #calendar {
        background-color: #2A2A2A;
        color: white;
        padding: 1rem;
        border-radius: 0.5rem;
    }

    /* Día del mes */
    .fc .fc-daygrid-day-number {
        color: white;
    }

    /* Fila del encabezado (días de la semana) */
    .fc .fc-col-header-cell-cushion {
        color: #FFFFFF;
    }

    /* Encabezado del mes */
    .fc-toolbar-title {
        color: #FFFFFF;
    }

    /* Botones */
    .fc-button {
        background-color: #1F1F1F !important;
        color: white !important;
        border: 1px solid #444 !important;
    }

    .fc-button:hover {
        background-color: #3B3B3B !important;
    }

    /* Fondo de celdas hover */
    .fc-daygrid-day:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }

    /* Eventos */
    .fc-event {
        border: none;
        font-weight: 500;
    }

    /* Fondo del encabezado de semana */
    .fc .fc-scrollgrid-section-header td {
        background-color: #1F1F1F;
    }

    /* Líneas del calendario */
    .fc-theme-standard td, .fc-theme-standard th {
        border: 1px solid #3B3B3B;
    }

    /* Solo para navegadores WebKit como Chrome, Edge, Brave, Safari */
input[type="date"]::-webkit-calendar-picker-indicator,
input[type="time"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    opacity: 1;
}

/* Para Firefox: mejora la compatibilidad general */
input[type="date"],
input[type="time"] {
    color-scheme: dark;
}
</style>


            </div>
        </div>
    </div>
</x-admin-app-layout>
