<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barberos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                {{-- Formulario de búsqueda --}}
                <form method="GET" action="{{ route('admin.barbers.index') }}" class="mb-6 flex flex-wrap gap-4 items-end">
                    {{-- Nombre --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" id="name" placeholder="Nombre"
                            value="{{ request('name') }}"
                            class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300 w-48" />
                    </div>

                    {{-- Apellido --}}
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Apellido"
                            value="{{ request('last_name') }}"
                            class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300 w-48" />
                    </div>

                    {{-- Especialidad --}}
                    <div>
                        <label for="specialty_id" class="block text-sm font-medium text-gray-700">Especialidad</label>
                        <select name="specialty_id" id="specialty_id"
                            class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300 w-48">
                            <option value="">-- Todas --</option>
                            @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}"
                                    {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>
                                    {{ $specialty->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 mt-5">Buscar</button>
                        <a href="{{ route('admin.barbers.index') }}"
                            class="mt-5 text-sm text-gray-600 hover:underline">Limpiar</a>
                    </div>
                </form>

                {{-- Mensaje de sesión --}}
                @if (session('message'))
                    <p class="text-green-600 mb-4">{{ session('message') }}</p>
                @endif

                {{-- Tabla de barberos --}}
                @if ($barbers->isEmpty())
                    <p class="text-gray-600">No hay barberos registrados.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 text-sm text-left">
                            <thead class="bg-gray-100 text-gray-700 uppercase">
                                <tr>
                                    <th class="px-4 py-2 border">ID</th>
                                    <th class="px-4 py-2 border">Nombre</th>
                                    <th class="px-4 py-2 border">Apellido</th>
                                    <th class="px-4 py-2 border">Especialidades</th>
                                    <th class="px-4 py-2 border">Email</th>
                                    <th class="px-4 py-2 border">Teléfono</th>
                                    <th class="px-4 py-2 border">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barbers as $barber)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $barber->id }}</td>
                                        <td class="px-4 py-2">{{ $barber->name }}</td>
                                        <td class="px-4 py-2">{{ $barber->last_name }}</td>
                                        <td class="px-4 py-2">
                                            @if ($barber->specialties->isNotEmpty())
                                                {{ $barber->specialties->pluck('name')->join(', ') }}
                                            @else
                                                <span class="text-gray-400 italic">Sin especialidades</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">{{ $barber->email }}</td>
                                        <td class="px-4 py-2">{{ $barber->phone_number }}</td>
                                        <td class="px-4 py-2 space-x-2">
                                            <a href="{{ route('admin.barbers.show', $barber) }}"
                                                class="text-blue-600 hover:underline">Ver</a>
                                            <a href="{{ route('admin.barbers.edit', $barber) }}"
                                                class="text-yellow-600 hover:underline">Editar</a>
                                            <form action="{{ route('admin.barbers.destroy', $barber) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('¿Seguro que deseas eliminar este barbero?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:underline">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $barbers->withQueryString()->links() }}
                    </div>
                @endif

                {{-- Crear nuevo --}}
                <div class="mt-6">
                    <a href="{{ route('admin.barbers.create') }}"
                        class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Crear nuevo barbero</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
