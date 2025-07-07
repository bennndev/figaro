<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Calendario de Horarios</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('admin.dashboard') }}" class="text-[#FFFFFF] flex items-center">
                <span>Inicio</span>
            </a>
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow-sm sm:rounded-lg p-6 text-white">

                {{-- Mensaje de éxito --}}
                @if (session('message'))
                    <p class="text-green-400 mb-4">
                        {{ session('message') }}
                    </p>
                @endif

                {{-- FullCalendar --}}
                <div id="calendar" class="bg-white rounded shadow"></div>

                {{-- FullCalendar Scripts --}}
                <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
                <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

                @php
                    $calendarEvents = $schedules->map(function ($s) {
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
    
    <x-admin.alert-delete />
    <x-admin.alert-success />

</x-admin-app-layout>