@props(['service'])

<div 
    x-data="{ showServiceModal: false }"
    x-on:open-modal-show-service-{{ $service->id }}.window="showServiceModal = true"
    class="z-50"
>
    <div 
        x-show="showServiceModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showServiceModal = false"
            class="bg-[#2A2A2A] rounded-2xl shadow-2xl w-full max-w-2xl p-6 text-white overflow-y-auto max-h-[90vh] custom-scroll"
        >
            <h3 class="text-2xl font-bold mb-4">
                Servicio: {{ $service->name }}
            </h3>

            <ul class="list-disc pl-5 space-y-2 text-white">
                <li><strong>Descripción:</strong> {{ $service->description }}</li>
                <li><strong>Duración:</strong> {{ $service->duration_minutes }} minutos</li>
                <li><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</li>
                <li><strong>Especialidades:</strong>
                    @if ($service->specialties->isNotEmpty())
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($service->specialties as $specialty)
                                <li>{{ $specialty->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <em class="text-gray-400">No tiene especialidades asociadas.</em>
                    @endif
                </li>
                <li><strong>Creado:</strong> {{ $service->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Actualizado:</strong> {{ $service->updated_at->format('d/m/Y H:i') }}</li>
            </ul>

            @if($service->image)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="Imagen del servicio"
     class="rounded-xl border border-white/10 shadow mx-auto object-cover w-64 h-64">

                </div>
            @endif

            <div class="mt-6 flex justify-end">
                <button @click="showServiceModal = false"
                        class="px-4 py-2 bg-white text-black font-semibold rounded hover:bg-gray-200 transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scrollbar oscuro -->
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
