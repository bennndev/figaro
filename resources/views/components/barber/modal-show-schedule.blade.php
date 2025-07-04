<!-- resources/views/components/modal-show-schedule.blade.php -->
<div x-data="{ showModal: false }">
    <!-- Botón para abrir el modal -->
    <a @click="showModal = true"
       class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 cursor-pointer"
       title="Ver">
        <i class="bi bi-eye-fill"></i>
    </a>

    <!-- Modal -->
    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div @click.outside="showModal = false"
             class="bg-[#1F1F1F] text-white w-full max-w-lg rounded-lg shadow-lg p-6">

            <h2 class="text-xl font-semibold mb-4">Detalle del Horario</h2>

            <div class="space-y-2">
                <p><strong>Nombre:</strong> {{ $schedule->name }}</p>
                <p><strong>ID:</strong> {{ $schedule->id }}</p>
                <p><strong>Fecha:</strong> {{ $schedule->date->format('Y-m-d') }}</p>
                <p><strong>Hora de Inicio:</strong> {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</p>
                <p><strong>Hora de Fin:</strong> {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($schedule->status) }}</p>
            </div>

            <div class="flex justify-end gap-4 mt-6">
                
                <button @click="showModal = false" class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>
