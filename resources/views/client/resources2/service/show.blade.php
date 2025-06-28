<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="md:w-1/2">
                            <img src="{{ asset('storage/' . $service->image) }}" 
                                 alt="{{ $service->name }}" 
                                 class="w-full h-96 object-cover rounded-lg shadow-lg">
                        </div>
                        <div class="md:w-1/2">
                            <h3 class="text-3xl font-bold text-gray-800 mb-4">
                                {{ $service->name }}
                            </h3>
                            
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <div class="text-gray-600">
                                        <span class="block text-sm">Duración</span>
                                        <span class="text-xl font-semibold">{{ $service->duration_minutes }} minutos</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="block text-sm text-gray-600">Precio</span>
                                        <span class="text-2xl font-bold text-green-600">S/. {{ number_format($service->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="prose max-w-none">
                                <h4 class="text-xl font-semibold mb-2">Descripción</h4>
                                <p class="text-gray-600 text-lg">
                                    {{ $service->description }}
                                </p>
                            </div>

                            <div class="mt-8">
                                <a href="{{ route('client.reservations.create') }}" 
                                   class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg w-full text-center text-lg">
                                    Reservar este servicio
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t pt-6">
                        <a href="{{ route('client.services.index') }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver al listado de servicios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
