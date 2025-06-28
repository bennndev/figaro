<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barberos') }}
        </h2>
    </x-slot>

    {{-- Formulario de Filtros --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <form method="GET" action="{{ route('client.barbers.index') }}" class="mb-6 bg-white p-6 rounded shadow-sm grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Nombre --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ $filters['name'] ?? '' }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Apellido --}}
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Apellido</label>
                    <input type="text" name="last_name" id="last_name" value="{{ $filters['last_name'] ?? '' }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Especialidad --}}
                <div>
                    <label for="specialty_id" class="block text-sm font-medium text-gray-700">Especialidad</label>
                    <select name="specialty_id" id="specialty_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Todas --</option>
                        @foreach($specialties as $specialty)
                            <option value="{{ $specialty->id }}"
                                {{ ($filters['specialty_id'] ?? '') == $specialty->id ? 'selected' : '' }}>
                                {{ $specialty->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botones --}}
                <div class="md:col-span-3 flex justify-end gap-4 mt-4">
                    <a href="{{ route('client.barbers.index') }}"
                       class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                        Limpiar filtros
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Grid de Barberos --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($barbers as $barber)
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <h3 class="text-xl font-bold">{{ $barber->name }} {{ $barber->last_name }}</h3>
                <p class="text-gray-600 mt-2">{{ Str::limit($barber->description, 100) }}</p>

                {{-- Especialidades --}}
                <div class="mt-2">
                    <p class="text-sm font-semibold text-gray-700">Especialidades:</p>
                    <div class="flex flex-wrap gap-1 mt-1">
                        @forelse($barber->specialties as $specialty)
                            <span class="bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded">
                                {{ $specialty->name }}
                            </span>
                        @empty
                            <span class="text-xs text-gray-500">Sin especialidades registradas</span>
                        @endforelse
                    </div>
                </div>

                <a href="{{ route('client.barbers.show', $barber->id) }}"
                   class="text-indigo-600 hover:underline mt-4 inline-block">Ver más</a>
            </div>
        @empty
            <p class="text-gray-600">No hay barberos disponibles en este momento.</p>
        @endforelse
    </div>

    {{-- Paginación --}}
    <div class="max-w-7xl mx-auto mt-8">
        {{ $barbers->appends($filters)->links() }}
    </div>
</x-app-layout>
