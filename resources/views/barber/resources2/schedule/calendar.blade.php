<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Calendario de Horarios</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('barber.dashboard') }}" class="text-white">Inicio</a>
        </h2>
    </x-slot>

    <div class="py-6 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <div class="bg-[#2A2A2A] shadow-sm sm:rounded-lg text-white p-6">

                {{-- Mensaje de éxito --}}
                <x-barber.alert-success />

                {{-- FullCalendar --}}
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
                            buttonText: {
                                today: 'Hoy',
                                month: 'Mes',
                                week: 'Semana',
                                day: 'Día',
                                
                            },
                            events: @json($calendarEvents)
                        });
                        calendar.render();
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
    
    <x-barber.alert-delete />
    <x-barber.alert-success />

</x-barber-app-layout>