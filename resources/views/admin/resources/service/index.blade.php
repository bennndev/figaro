<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Acá se listarán los servicios") }}
                </div>

                <div style="padding: 20px;">
                    {{-- Formulario de filtros --}}
                    <form method="GET" action="{{ route('admin.services.index') }}" style="margin-bottom: 20px;">
                        <label for="name">Nombre:</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ request('name') }}"
                            placeholder="Buscar por nombre"
                            style="margin-right: 10px;"
                        >
                        <button type="submit">Buscar</button>
                        <a href="{{ route('admin.services.index') }}" style="margin-left: 10px;">Limpiar</a>
                    </form>

                    {{-- Mensaje de éxito --}}
                    @if (session('message'))
                        <p style="color: green; margin-bottom: 10px;">
                            {{ session('message') }}
                        </p>
                    @endif

                    {{-- Tabla de resultados --}}
                    @if ($services->isEmpty())
                        <p>No hay servicios registrados.</p>
                    @else
                        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                            <thead style="background-color: #f2f2f2;">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Duración (min)</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $service->id }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->duration_minutes }}</td>
                                        <td>${{ number_format($service->price, 2) }}</td>
                                        <td>
                                            <a href="{{ route('admin.services.show', $service->id) }}">Ver</a> |
                                            <a href="{{ route('admin.services.edit', $service->id) }}">Editar</a> |
                                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar este servicio?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <div style="margin-top: 20px;">
                        <a href="{{ route('admin.services.create') }}">Crear nuevo servicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
