<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuestros Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Filtros --}}
                    <form method="GET" action="{{ route('client.services.index') }}" class="mb-6">
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre del servicio:</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ request('name') }}"
                                    placeholder="Buscar por nombre"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Buscar
                                </button>
                                <a href="{{ route('client.services.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Limpiar</a>
                            </div>
                        </div>
                    </form>

                    @if ($services->isEmpty())
                        <p class="text-center text-gray-500 my-8">No hay servicios disponibles.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($services as $service)
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    <img src="{{ asset('storage/' . $service->image) }}" 
                                         alt="{{ $service->name }}" 
                                         class="w-full h-48 object-cover">
                                    <div class="p-6">
                                        <div class="flex justify-between items-start mb-4">
                                            <h3 class="text-xl font-bold text-gray-800">
                                                {{ $service->name }}
                                            </h3>
                                            <div class="text-right">
                                                <span class="block text-2xl font-bold text-green-600">
                                                    S/. {{ number_format($service->price, 2) }}
                                                </span>
                                                <span class="text-sm text-gray-500">
                                                    {{ $service->duration_minutes }} minutos
                                                </span>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 mb-4">
                                            {{ $service->description }}
                                        </p>
                                        <div class="mt-4">
                                            <a href="{{ route('client.services.show', $service->id) }}" 
                                               class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full text-center">
                                                Ver detalles
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
