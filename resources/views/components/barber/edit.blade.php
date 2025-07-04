<!-- resources/views/components/barber/edit.blade.php -->
@props(['schedule'])

<div x-data="{ showEditModal: false }" class="inline">
    <!-- Botón para abrir el modal -->
    <button @click="showEditModal = true"
        class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 bg-transparent border-none p-0"
        title="Editar">
        <i class="bi bi-pencil-square"></i>
    </button>

    <!-- Modal -->
    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div @click.outside="showEditModal = false"
            class="bg-[#1E1E1E] text-white rounded-lg shadow-lg w-full max-w-xl p-6">
            
            <h2 class="text-xl font-semibold mb-4">Editar Horario</h2>

            {{-- Formulario --}}
            <form method="POST" action="{{ route('barber.schedules.update', $schedule->id) }}">
                @csrf
                @method('PUT')

                {{-- Nombre --}}
                <div class="mb-4">
                    <label for="name" class="block mb-1 text-sm font-medium">Nombre del Horario</label>
                    <input type="text" id="name" name="name"
                        value="{{ old('name', $schedule->name) }}"
                        class="w-full px-3 py-2 rounded-md border border-gray-600 bg-[#2A2A2A] text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>

                {{-- Fecha --}}
                <div class="mb-4">
                    <label for="date" class="block mb-1 text-sm font-medium">Fecha</label>
                    <input type="date" id="date" name="date"
                        value="{{ old('date', $schedule->date->format('Y-m-d')) }}"
                        class="w-full px-3 py-2 rounded-md border border-gray-600 bg-[#2A2A2A] text-white focus:outline-none focus:border-blue-500">
                </div>

                {{-- Hora de Inicio --}}
                <div class="mb-4">
                    <label for="start_time" class="block mb-1 text-sm font-medium">Hora de Inicio</label>
                    <input type="time" id="start_time" name="start_time"
                        value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"
                        class="w-full px-3 py-2 rounded-md border border-gray-600 bg-[#2A2A2A] text-white focus:outline-none focus:border-blue-500">
                </div>

                {{-- Hora de Fin --}}
                <div class="mb-4">
                    <label for="end_time" class="block mb-1 text-sm font-medium">Hora de Fin</label>
                    <input type="time" id="end_time" name="end_time"
                        value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"
                        class="w-full px-3 py-2 rounded-md border border-gray-600 bg-[#2A2A2A] text-white focus:outline-none focus:border-blue-500">
                </div>

                {{-- Botones --}}
                <div class="flex justify-end gap-3 mt-6">
                    <button type="submit"
                        class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition">
                        Actualizar
                    </button>
                    <button type="button"
                        @click="showEditModal = false"
                        class="text-gray-400 hover:text-white transition">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
