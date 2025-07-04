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
            class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 text-black"
        >
            <h3 class="text-lg font-bold mb-4">
                Servicio: {{ $service->name }}
            </h3>

            <ul class="list-disc pl-5 space-y-1">
                <li><strong>Descripción:</strong> {{ $service->description }}</li>
                <li><strong>Duración:</strong> {{ $service->duration_minutes }} minutos</li>
                <li><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</li>
                <li><strong>Especialidades:</strong>
                    @if ($service->specialties->isNotEmpty())
                        <ul class="list-disc pl-5">
                            @foreach ($service->specialties as $specialty)
                                <li>{{ $specialty->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <em>No tiene especialidades asociadas.</em>
                    @endif
                </li>
                <li><strong>Creado:</strong> {{ $service->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Actualizado:</strong> {{ $service->updated_at->format('d/m/Y H:i') }}</li>
            </ul>

            @if($service->image)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="Imagen del servicio"
                         class="rounded w-full max-w-md">
                </div>
            @endif

            <div class="mt-6 flex justify-end">
                <button @click="showServiceModal = false" class="text-gray-600 hover:text-gray-900">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
