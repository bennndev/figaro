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
            class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 text-black"
        >
            <h2 class="text-xl font-bold mb-4">Editar Horario</h2>

            <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}">
                @csrf
                @method('PUT')

                {{-- Barbero --}}
                <div class="mb-4">
                    <label for="barber_id" class="block font-medium">Barbero</label>
                    <select name="barber_id" id="barber_id" class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                        @foreach ($barbers as $barber)
                            <option value="{{ $barber->id }}" {{ $schedule->barber_id == $barber->id ? 'selected' : '' }}>
                                {{ $barber->first_name }} {{ $barber->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Nombre del horario --}}
                <div class="mb-4">
                    <label for="name" class="block font-medium">Nombre del horario</label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name', $schedule->name) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                </div>

                {{-- Fecha --}}
                <div class="mb-4">
                    <label for="date" class="block font-medium">Fecha</label>
                    <input type="date" name="date" id="date"
                        value="{{ old('date', $schedule->date->format('Y-m-d')) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                </div>

                {{-- Hora de inicio --}}
                <div class="mb-4">
                    <label for="start_time" class="block font-medium">Hora de inicio</label>
                    <input type="time" name="start_time" id="start_time"
                        value="{{ old('start_time', $schedule->start_time) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                </div>

                {{-- Hora de fin --}}
                <div class="mb-4">
                    <label for="end_time" class="block font-medium">Hora de fin</label>
                    <input type="time" name="end_time" id="end_time"
                        value="{{ old('end_time', $schedule->end_time) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                </div>

                {{-- Estado --}}
                <div class="mb-4">
                    <label for="status" class="block font-medium">Estado</label>
                    <select name="status" id="status"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                        <option value="available" {{ $schedule->status === 'available' ? 'selected' : '' }}>Disponible</option>
                        <option value="booked" {{ $schedule->status === 'booked' ? 'selected' : '' }}>Reservado</option>
                    </select>
                </div>

                {{-- Botones --}}
                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md">
                        Actualizar
                    </button>
                    <button type="button" @click="showEditScheduleModal = false"
                        class="text-gray-600 hover:text-gray-900">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
