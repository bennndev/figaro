<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Listado de tus reservas') }}
                </div>

                <div style="padding: 20px;">
                    {{-- Formulario de filtros --}}
                    <form method="GET" action="{{ route('client.reservations.index') }}" style="margin-bottom: 20px;">
                        <label for="date">Fecha:</label>
                        <input
                            type="date"
                            name="date"
                            id="date"
                            value="{{ request('date') }}"
                            style="margin-right: 10px;"
                        >
                        <button type="submit">Buscar</button>
                        <a href="{{ route('client.reservations.index') }}" style="margin-left: 10px;">Limpiar</a>
                    </form>

                    {{-- Mensaje de éxito --}}
                    @if (session('message'))
                        <p style="color: green; margin-bottom: 10px;">
                            {{ session('message') }}
                        </p>
                    @endif

                    {{-- Tabla de resultados --}}
                    @if ($reservations->isEmpty())
                        <p>No tienes reservaciones registradas.</p>
                    @else
                        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                            <thead style="background-color: #f2f2f2;">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                    <th>Notas</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->id }}</td>
                                        <td>{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                                        <td>{{ $reservation->reservation_time->format('H:i') }}</td>
                                        <td>{{ $reservation->note }}</td>
                                        <td>
                                            <a href="{{ route('client.reservations.show', $reservation->id) }}">Ver</a> |
                                            @if($reservation->status === 'pending_pay')
                                                <a href="{{ route('client.reservations.edit', $reservation->id) }}">Editar</a> |
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <div style="margin-top: 20px;">
                        <a href="{{ route('client.reservations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nueva Reservación</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>