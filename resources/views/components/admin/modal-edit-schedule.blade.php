@props(['schedule', 'barbers'])

<div 
    x-data="{ showEditScheduleModal: false }"
    x-on:open-modal-edit-schedule-{{ $schedule->id }}.window="showEditScheduleModal = true"
    class="z-50"
>
    <div 
        x-show="showEditScheduleModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showEditScheduleModal = false"
            class="bg-[#2A2A2A] text-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 overflow-y-auto max-h-[90vh] custom-scroll"
        >
            <h2 class="text-2xl font-bold mb-4">Editar Horario</h2>

            <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}">
                @csrf
                @method('PUT')

                {{-- Barbero --}}
                <div class="mb-4">
                    <label for="barber_id" class="block text-sm font-medium mb-1">Barbero</label>
                    <select name="barber_id" id="barber_id"
                        class="w-full p-2 rounded-md bg-[#1E1E1E] border border-gray-600 text-white" required>
                        @foreach ($barbers as $barber)
                            <option value="{{ $barber->id }}" {{ $schedule->barber_id == $barber->id ? 'selected' : '' }}>
                                {{ $barber->first_name }} {{ $barber->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Nombre del horario --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-1">Nombre del horario</label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name', $schedule->name) }}"
                        class="w-full p-2 rounded-md bg-[#1E1E1E] border border-gray-600 text-white" required>
                </div>

                {{-- Fecha --}}
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium mb-1">Fecha</label>
                    <input type="date" name="date" id="date"
                        value="{{ old('date', $schedule->date->format('Y-m-d')) }}"
                        class="w-full p-2 rounded-md bg-[#1E1E1E] border border-gray-600 text-white" required>
                </div>

                {{-- Hora de inicio --}}
                <div class="mb-4">
                    <label for="start_time" class="block text-sm font-medium mb-1">Hora de inicio</label>
                    <input type="time" name="start_time" id="start_time"
                        value="{{ old('start_time', $schedule->start_time) }}"
                        class="w-full p-2 rounded-md bg-[#1E1E1E] border border-gray-600 text-white" required>
                </div>

                {{-- Hora de fin --}}
                <div class="mb-4">
                    <label for="end_time" class="block text-sm font-medium mb-1">Hora de fin</label>
                    <input type="time" name="end_time" id="end_time"
                        value="{{ old('end_time', $schedule->end_time) }}"
                        class="w-full p-2 rounded-md bg-[#1E1E1E] border border-gray-600 text-white" required>
                </div>

                {{-- Estado --}}
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium mb-1">Estado</label>
                    <select name="status" id="status"
                        class="w-full p-2 rounded-md bg-[#1E1E1E] border border-gray-600 text-white" required>
                        <option value="available" {{ $schedule->status === 'available' ? 'selected' : '' }}>Disponible</option>
                        <option value="booked" {{ $schedule->status === 'booked' ? 'selected' : '' }}>Reservado</option>
                    </select>
                </div>

                {{-- Botones --}}
                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit"
                        class="bg-white text-[#2A2A2A] font-semibold px-4 py-2 rounded-md hover:bg-gray-200 transition">
                        Actualizar
                    </button>
                    <button type="button" @click="showEditScheduleModal = false"
                        class="text-white hover:underline transition">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scroll personalizado -->
<style>
.custom-scroll::-webkit-scrollbar {
    width: 6px;
}
.custom-scroll::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scroll::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
}
.custom-scroll:hover::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.4);
}
.custom-scroll {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
}
.custom-scroll:hover {
    scrollbar-color: rgba(255, 255, 255, 0.4) transparent;
}


</style>
<style>
/* Íconos blancos para campos de fecha y hora en navegadores WebKit (Chrome, Edge, Safari) */
input[type="date"]::-webkit-calendar-picker-indicator,
input[type="time"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    opacity: 1;
}

/* Firefox: intenta forzar esquema oscuro */
input[type="date"],
input[type="time"] {
    color-scheme: dark;
}
</style>
