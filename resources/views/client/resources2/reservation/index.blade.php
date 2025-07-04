<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">Listado de tus reservas</h3>

                {{-- Mensaje de éxito --}}
                @if (session('message'))
                    <p class="text-green-400 mb-4">{{ session('message') }}</p>
                @endif

                @if ($reservations->isEmpty())
                    <p>No tienes reservaciones registradas.</p>
                @else
                    <table class="w-full border-collapse border border-gray-700">
                        <thead class="bg-[#1E1E1E] text-white">
                            <tr>
                                <th class="border border-gray-700 px-4 py-2">ID</th>
                                <th class="border border-gray-700 px-4 py-2">Fecha</th>
                                <th class="border border-gray-700 px-4 py-2">Hora</th>
                                <th class="border border-gray-700 px-4 py-2">Estado</th>
                                <th class="border border-gray-700 px-4 py-2">Notas</th>
                                <th class="border border-gray-700 px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="border border-gray-700 px-4 py-2">{{ $reservation->id }}</td>
                                    <td class="border border-gray-700 px-4 py-2">{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                                    <td class="border border-gray-700 px-4 py-2">{{ $reservation->reservation_time->format('H:i') }}</td>
                                    <td class="border border-gray-700 px-4 py-2">{{ ucfirst($reservation->status) }}</td>
                                    <td class="border border-gray-700 px-4 py-2">{{ $reservation->note }}</td>
                                    <td class="border border-gray-700 px-4 py-2">
                                        <a href="{{ route('client.reservations.show', $reservation->id) }}" class="text-blue-400 hover:underline">Ver</a>
                                        @if($reservation->status === 'pending_pay')
                                            | <a href="{{ route('client.reservations.edit', $reservation->id) }}" class="text-yellow-400 hover:underline">Editar</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <div x-data="{ openModal: false }">
    <!-- Botón para abrir el modal -->
    <div class="mt-6">
    <a href="#" onclick="openReservationModal()" class="bg-white text-black py-2 px-4 rounded hover:bg-gray-200 transition">
    Nueva Reservación
</a>

</div>

<!-- Modal -->
<div id="reservationModal" class="hidden fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center">
    <x-reservation-wizard />
</div>

            </div>
        </div>
    </div>
</x-app-layout>
