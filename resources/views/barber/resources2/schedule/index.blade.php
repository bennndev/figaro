<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Horario del Barbero</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('barber.dashboard') }}" class="text-white">Inicio</a>
        </h2>
    </x-slot>

    <div class="py-6 min-h-screen">
        <div class="max-w-7xl mx-auto ">
            <div class="bg-[#2A2A2A] shadow-sm sm:rounded-lg text-white p-6">

                {{-- Mensaje de éxito --}}
               <x-barber.alert-success />
 


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
                    <div class="w-full overflow-x-auto rounded-xl border border-gray-700">
    <table class="min-w-full table-auto text-left bg-[#1E1E1E] text-white">

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

            </div>
        </div>
    </div>

    <style>
/* Mejor visibilidad del input date/time */
input[type="date"],
input[type="time"],
select {
    background-color: #1F1F1F;
    color: white;
    border: 1px solid #555;
}

input[type="date"]::-webkit-calendar-picker-indicator,
input[type="time"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
    opacity: 0.8;
}

input[type="date"]:hover::-webkit-calendar-picker-indicator,
input[type="time"]:hover::-webkit-calendar-picker-indicator {
    opacity: 1;
}
                </style>

            </div>
        </div>
    </div>
    <x-barber.alert-delete />
    <x-barber.alert-success />

</x-barber-app-layout>
