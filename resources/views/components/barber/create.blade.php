<div x-data="{ showModal: false }">
    <!-- Botón para abrir el modal -->
    <div class="mt-6 flex justify-end">
        <button @click="showModal = true"
            class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition">
            <i class="bi bi-plus-lg"></i> Nuevo horario
        </button>
    </div>

    <!-- Modal -->
    <div x-show="showModal" x-cloak class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-60">
        <div @click.outside="showModal = false"
            class="bg-[#2A2A2A] text-white rounded-xl shadow-lg w-full max-w-xl p-6">
            
            <!-- Título -->
            <h2 class="text-xl font-semibold text-white mb-4">Crear Horario</h2>

            <!-- Formulario -->
            <form method="POST" action="{{ route('barber.schedules.store') }}">
                @csrf

                <!-- Fecha -->
                <div class="mb-4">
                    <label for="date" class="block font-medium text-sm text-white mb-1">Fecha</label>
                    <input type="date" id="date" name="date" value="{{ old('date') }}"
                        class="w-full px-3 py-2 bg-[#1E1E1E] text-white border border-gray-600 rounded focus:outline-none focus:border-blue-500">
                </div>

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block font-medium text-sm text-white mb-1">Nombre del Horario</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-3 py-2 bg-[#1E1E1E] text-white border border-gray-600 rounded focus:outline-none focus:border-blue-500" required>
                </div>

                <!-- Hora de inicio -->
                <div class="mb-4">
                    <label for="start_time" class="block font-medium text-sm text-white mb-1">Hora de Inicio</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}"
                        class="w-full px-3 py-2 bg-[#1E1E1E] text-white border border-gray-600 rounded focus:outline-none focus:border-blue-500">
                </div>

                <!-- Hora de fin -->
                <div class="mb-4">
                    <label for="end_time" class="block font-medium text-sm text-white mb-1">Hora de Fin</label>
                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time') }}"
                        class="w-full px-3 py-2 bg-[#1E1E1E] text-white border border-gray-600 rounded focus:outline-none focus:border-blue-500">
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit"
                        class="bg-white text-[#2A2A2A] font-semibold px-4 py-2 rounded-md hover:bg-white/90 transition">
                        Guardar
                    </button>
                    <button type="button" @click="showModal = false"
                        class="text-gray-300 hover:text-white">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    
    <x-utils.modal-error key="showModal" />
</div>
