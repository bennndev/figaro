<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Mis reservas</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('barber.dashboard') }}" class="text-[#FFFFFF] flex items-center">
                <span>Inicio</span>
            </a>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg px-4 sm:px-6 lg:px-8 py-6">

                <h3 class="text-lg font-semibold mb-4">Listado de tus reservas</h3>

                {{-- Mensaje de éxito --}}
                @if (session('message'))
                    <p class="text-green-400 mb-4">{{ session('message') }}</p>
                @endif

@if ($reservations->isEmpty())
    <p class="text-white">No tienes reservaciones registradas.</p>
@else
    <x-admin.table>
        <x-slot name="head">
            <tr>
                <th class="px-4 py-2 font-semibold">ID</th>
                <th class="px-4 py-2 font-semibold">Cliente</th>
                <th class="px-4 py-2 font-semibold">Fecha</th>
                <th class="px-4 py-2 font-semibold">Hora</th>
                <th class="px-4 py-2 font-semibold">Estado</th>
                <th class="px-4 py-2 font-semibold">Nota</th>
                <th class="px-4 py-2 font-semibold">Acciones</th>
            </tr>
        </x-slot>

        @foreach ($reservations as $reservation)
            <tr class="hover:bg-[#FFFFFF]/20 transition">
                <td class="px-4 py-2">{{ $reservation->id }}</td>
                <td class="px-4 py-2">{{ $reservation->user->name ?? 'N/A' }} {{ $reservation->user->last_name ?? '' }}</td>
                <td class="px-4 py-2">{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                <td class="px-4 py-2">{{ $reservation->reservation_time->format('H:i') }}</td>
                <td class="px-4 py-2">
                    @if ($reservation->status === 'paid')
                        <span class="inline-block px-3 py-1 bg-white text-[#2A2A2A] text-sm font-semibold rounded-full">
                            {{ __('validation.reservation_status.paid') }}
                        </span>
                    @elseif ($reservation->status === 'pending_pay')
                        <span class="inline-block px-3 py-1 border border-white text-white text-sm font-semibold rounded-full">
                            {{ __('validation.reservation_status.pending_pay') }}
                        </span>
                    @elseif ($reservation->status === 'cancelled')
                        <span class="inline-block px-3 py-1 bg-red-600 text-white text-sm font-semibold rounded-full">
                            {{ __('validation.reservation_status.cancelled') }}
                        </span>
                    @elseif ($reservation->status === 'completed')
                        <span class="inline-block px-3 py-1 bg-blue-600 text-white text-sm font-semibold rounded-full">
                            {{ __('validation.reservation_status.completed') }}
                        </span>
                    @else
                        <span class="inline-block px-3 py-1 bg-gray-600 text-white text-sm font-semibold rounded-full">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    @endif
                </td>

                <td class="px-4 py-2">{{ $reservation->note ?? '—' }}</td>
                <td class="px-4 py-2 flex space-x-3 whitespace-nowrap">
                    {{-- Ver --}}
                    <a href="{{ route('barber.reservations.show', $reservation->id) }}" 
                        class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 transition" 
                        title="Ver detalle"
                    >
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    
                    {{-- Marcar como completado (solo si está pagado, no completado) --}}
                    @if($reservation->status === 'paid')
                        <button type="button" 
                            class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 transition" 
                            title="Marcar como completado"
                            onclick="markAsCompleted({{ $reservation->id }})"
                        >
                            <i class="bi bi-check-lg"></i>
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </x-admin.table>
@endif

            </div>
        </div>
    </div>

    {{-- Script para marcar como completado --}}
    <script>
        function markAsCompleted(reservationId) {
            // Mostrar confirmación
            if (confirm('¿Está seguro de que desea marcar esta reserva como completada?')) {
                
                // Hacer petición AJAX al servidor
                fetch(`/barber/reservations/${reservationId}/complete`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        // Recargar la página para mostrar el cambio
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud.');
                });
            }
        }
    </script>

</x-barber-app-layout>
