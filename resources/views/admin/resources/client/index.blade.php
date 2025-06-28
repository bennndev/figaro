<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Botón Crear --}}
                    <div class="mb-6">
                        <a href="{{ route('admin.clients.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            + Nuevo Cliente
                        </a>
                    </div>

                    {{-- Filtros --}}
                    <form method="GET" action="{{ route('admin.clients.index') }}" class="mb-6 flex flex-wrap items-center gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre:</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ request('name') }}"
                                placeholder="Buscar por nombre"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Apellido:</label>
                            <input
                                type="text"
                                name="last_name"
                                id="last_name"
                                value="{{ request('last_name') }}"
                                placeholder="Buscar por apellido"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >
                        </div>

                        <div class="flex items-end gap-2 mt-4">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Buscar</button>
                            <a href="{{ route('admin.clients.index') }}" class="text-sm text-gray-600 hover:underline">Limpiar</a>
                        </div>
                    </form>

                    {{-- Mensaje éxito --}}
                    @if (session('message'))
                        <p class="text-green-600 mb-4">{{ session('message') }}</p>
                    @endif

                    {{-- Tabla --}}
                    @if ($clients->isEmpty())
                        <p>No hay clientes registrados.</p>
                    @else
                        <table class="w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Nombre</th>
                                    <th class="px-4 py-2 text-left">Apellido</th>
                                    <th class="px-4 py-2 text-left">Email</th>
                                    <th class="px-4 py-2 text-left">Teléfono</th>
                                    <th class="px-4 py-2 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $client->id }}</td>
                                        <td class="px-4 py-2">{{ $client->name }}</td>
                                        <td class="px-4 py-2">{{ $client->last_name }}</td>
                                        <td class="px-4 py-2">{{ $client->email }}</td>
                                        <td class="px-4 py-2">{{ $client->phone_number }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('admin.clients.show', $client->id) }}" class="text-blue-600 hover:underline">Ver</a> |
                                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="text-yellow-600 hover:underline">Editar</a> |
                                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    {{-- Paginación --}}
                    <div class="mt-4">
                        {{ $clients->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
