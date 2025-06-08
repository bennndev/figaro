<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Servicio: {{ $service->name }}</h3>

                <div class="mb-4">
                    <strong>Descripción:</strong>
                    <p>{{ $service->description }}</p>
                </div>

                <div class="mb-4">
                    <strong>Duración (minutos):</strong> {{ $service->duration_minutes }}
                </div>

                <div class="mb-4">
                    <strong>Precio:</strong> ${{ number_format($service->price, 2) }}
                </div>

                @if($service->image)
                    <div class="mb-4">
                        <strong>Imagen:</strong><br>
                        <img src="{{ asset('storage/' . $service->image) }}" alt="Imagen del servicio" style="max-width: 300px; height: auto; border-radius: 6px;">
                    </div>
                @endif

                <ul class="list-disc pl-5">
                    <li><strong>Creado:</strong> {{ $service->created_at->format('d/m/Y H:i') }}</li>
                    <li><strong>Actualizado:</strong> {{ $service->updated_at->format('d/m/Y H:i') }}</li>
                </ul>

                <div class="mt-6">
                    <a href="{{ route('admin.services.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
