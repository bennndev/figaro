<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Filtros --}}
            <form method="GET" action="{{ route('client.services.index') }}" class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Filtro por nombre --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre del servicio</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ request('name') }}"
                            placeholder="Buscar por nombre"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                    </div>

                    {{-- Filtro por especialidad --}}
                    <div>
                        <label for="specialty_id" class="block text-sm font-medium text-gray-700">Especialidad</label>
                        <select
                            name="specialty_id"
                            id="specialty_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">-- Todas --</option>
                            @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}" {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>
                                    {{ $specialty->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="flex items-end gap-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Buscar
                        </button>
                        <a href="{{ route('client.services.index') }}" class="text-gray-600 hover:text-gray-900">Limpiar</a>
                    </div>
                </div>
            </form>


            {{-- Resultados --}}
            @if ($services->isEmpty())
                <p class="text-center text-gray-500 mt-10">No hay servicios disponibles.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($services as $service)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
                                class="w-full h-48 object-cover rounded-md mb-4">
                            <h3 class="text-xl font-bold">{{ $service->name }}</h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit($service->description, 100) }}</p>
                            <p class="mt-2"><strong>Duración:</strong> {{ $service->duration_minutes }} min</p>
                            <p><strong>Precio:</strong> S/. {{ number_format($service->price, 2) }}</p>
                            <a href="{{ route('client.services.show', $service->id) }}"
                                class="text-indigo-600 hover:underline mt-4 inline-block">Ver más</a>
                        </div>
                    @endforeach
                </div>

                {{-- Paginación --}}
                <div class="mt-8">
                    {{ $services->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
