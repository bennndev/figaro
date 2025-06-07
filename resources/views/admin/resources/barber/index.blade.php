<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barberos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Filtros --}}
                    <form method="GET" action="{{ route('admin.barbers.index') }}" style="margin-bottom: 20px;">
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
                        <a href="{{ route('admin.barbers.index') }}" style="margin-left: 10px;">Limpiar</a>
                    </form>

                    {{-- Mensaje éxito --}}
                    @if (session('message'))
                        <p style="color: green; margin-bottom: 10px;">{{ session('message') }}</p>
                    @endif

                    @if ($barbers->isEmpty())
                        <p>No hay barberos registrados.</p>
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
                                @foreach ($barbers as $barber)
                                    <tr>
                                        <td>{{ $barber->id }}</td>
                                        <td>{{ $barber->name }}</td>
                                        <td>{{ $barber->last_name }}</td>
                                        <td>{{ $barber->email }}</td>
                                        <td>{{ $barber->phone_number }}</td>
                                        <td>
                                            <a href="{{ route('admin.barbers.show', $barber->id) }}">Ver</a> |
                                            <a href="{{ route('admin.barbers.edit', $barber->id) }}">Editar</a> |
                                            <form action="{{ route('admin.barbers.destroy', $barber->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este barbero?');">
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
                        <a href="{{ route('admin.barbers.create') }}">Crear nuevo barbero</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
