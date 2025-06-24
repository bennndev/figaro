<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">Listado de tus reservas</h3>

                {{-- Mensaje de éxito --}}
                @if (session('message'))
                    <p class="text-green-600 mb-4">{{ session('message') }}</p>
                @endif

                @if ($reservations->isEmpty())
                    <p>No tienes reservaciones registradas.</p>
                @else
                    <table class="w-full border-collapse border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Fecha</th>
                                <th class="border px-4 py-2">Hora</th>
                                <th class="border px-4 py-2">Estado</th>
                                <th class="border px-4 py-2">Notas</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="border px-4 py-2">{{ $reservation->id }}</td>
                                    <td class="border px-4 py-2">{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                                    <td class="border px-4 py-2">{{ $reservation->reservation_time->format('H:i') }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($reservation->status) }}</td>
                                    <td class="border px-4 py-2">{{ $reservation->note }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('client.reservations.show', $reservation->id) }}" class="text-blue-600 hover:underline">Ver</a>
                                        @if($reservation->status === 'pending_pay')
                                            | <a href="{{ route('client.reservations.edit', $reservation->id) }}" class="text-yellow-600 hover:underline">Editar</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <div class="mt-6">
                    <a href="{{ route('client.reservations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Nueva Reservación
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
