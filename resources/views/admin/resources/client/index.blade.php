<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                        <p style="color: green; margin-bottom: 10px;">{{ session('message') }}</p>
                    @endif

                    @if ($clients->isEmpty())
                        <p>No hay clientes registrados.</p>
                    @else
                        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                            <thead style="background-color: #f2f2f2;">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->last_name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phone_number }}</td>
                                        <td>
                                            <a href="{{ route('admin.clients.show', $client->id) }}">Ver</a> |
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="mt-4">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
