<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especialidades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Acá se listaran las especialidades") }}
                </div>

                <div style="padding: 20px;">
                    {{-- Formulario de filtros --}}
                    <form method="GET" action="{{ route('admin.specialties.index') }}" style="margin-bottom: 20px;">
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
                        <a href="{{ route('admin.specialties.index') }}" style="margin-left: 10px;">Limpiar</a>
                    </form>

                    {{-- Mensaje de éxito --}}
                    @if (session('message'))
                        <p style="color: green; margin-bottom: 10px;">
                            {{ session('message') }}
                        </p>
                    @endif

                    {{-- Tabla de resultados --}}
                    @if ($specialties->isEmpty())
                        <p>No hay especialidades registradas.</p>
                    @else
                        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                            <thead style="background-color: #f2f2f2;">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($specialties as $specialty)
                                    <tr>
                                        <td>{{ $specialty->id }}</td>
                                        <td>{{ $specialty->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.specialties.show', $specialty->id) }}">Ver</a> |
                                            <a href="{{ route('admin.specialties.edit', $specialty->id) }}">Editar</a> |
                                            <form action="{{ route('admin.specialties.destroy', $specialty->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta especialidad?');">
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
                        <a href="{{ route('admin.specialties.create') }}">Crear nueva especialidad</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
