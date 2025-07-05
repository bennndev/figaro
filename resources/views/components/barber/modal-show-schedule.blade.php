<!-- resources/views/components/modal-show-schedule.blade.php -->
<div x-data="{ showModal: false }">
    <!-- Botón para abrir el modal -->
    <a @click="showModal = true"
       class="text-white hover:text-white/70 cursor-pointer"
       title="Ver">
        <i class="bi bi-eye-fill"></i>
    </a>

    <!-- Modal -->
    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div @click.outside="showModal = false"
             class="bg-[#1E1E1E] text-white w-full max-w-lg rounded-xl shadow-xl p-6 space-y-4 transition-all transform scale-100">
            
            <h2 class="text-xl font-bold border-b border-white/10 pb-2">Detalle del Horario</h2>

            <div class="space-y-1 text-sm sm:text-base">
                <p><span class="font-semibold">Nombre:</span> {{ $schedule->name }}</p>
                <p><span class="font-semibold">ID:</span> {{ $schedule->id }}</p>
                <p><span class="font-semibold">Fecha:</span> {{ $schedule->date->format('Y-m-d') }}</p>
                <p><span class="font-semibold">Hora de Inicio:</span> {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</p>
                <p><span class="font-semibold">Hora de Fin:</span> {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</p>
                <p><span class="font-semibold">Estado:</span> {{ ucfirst($schedule->status) }}</p>
            </div>

            <div class="flex justify-end pt-4">
                <button @click="showModal = false"
                        class="px-4 py-2 bg-white text-black font-semibold rounded hover:bg-gray-200 transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
