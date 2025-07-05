@props(['schedule'])

<div 
    x-data="{ showScheduleModal: false }"
    x-on:open-modal-show-schedule-{{ $schedule->id }}.window="showScheduleModal = true"
    class="z-50"
>
    <div 
        x-show="showScheduleModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showScheduleModal = false"
            class="bg-[#2A2A2A] text-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 overflow-y-auto max-h-[90vh] custom-scroll"
        >
            <h2 class="text-2xl font-bold mb-4">Detalle del Horario</h2>

            <ul class="list-disc pl-5 space-y-2 text-white">
                <li><strong>ID:</strong> {{ $schedule->id }}</li>
                <li><strong>Barbero:</strong> {{ $schedule->barber->first_name }} {{ $schedule->barber->last_name }}</li>
                <li><strong>Nombre:</strong> {{ $schedule->name }}</li>
                <li><strong>Fecha:</strong> {{ $schedule->date->format('Y-m-d') }}</li>
                <li><strong>Hora de inicio:</strong> {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</li>
                <li><strong>Hora de fin:</strong> {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</li>
                <li><strong>Estado:</strong> {{ ucfirst($schedule->status) }}</li>
            </ul>

            <div class="mt-6 flex justify-end">
                <button @click="showScheduleModal = false"
                        class="text-white hover:text-gray-300 transition font-semibold">
                    Cerrar
                </button>
            </div>
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
