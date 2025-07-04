<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Mis reservas</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('dashboard') }}" class="text-[#FFFFFF] flex items-center">
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
                <th class="px-4 py-2 font-semibold">Fecha</th>
                <th class="px-4 py-2 font-semibold">Hora</th>
                <th class="px-4 py-2 font-semibold">Estado</th>
                <th class="px-4 py-2 font-semibold">Notas</th>
                <th class="px-4 py-2 font-semibold">Acciones</th>
            </tr>
        </x-slot>

        @foreach ($reservations as $reservation)
            <tr class="hover:bg-[#FFFFFF]/20 transition">
                <td class="px-4 py-2">{{ $reservation->id }}</td>
                <td class="px-4 py-2">{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                <td class="px-4 py-2">{{ $reservation->reservation_time->format('H:i') }}</td>
                <td class="px-4 py-2">
                    @if ($reservation->status === 'paid')
                        <span class="inline-block px-3 py-1 bg-white text-[#2A2A2A] text-sm font-semibold rounded-full">
                            Pagado
                        </span>
                    @elseif ($reservation->status === 'pending_pay')
                        <span class="inline-block px-3 py-1 border border-white text-white text-sm font-semibold rounded-full">
                            Pendiente
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
                    <button 
                        @click="$dispatch('open-modal-show-reservation-{{ $reservation->id }}')" 
                        class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 transition" 
                        title="Ver"
                    >
                        <i class="bi bi-eye-fill"></i>
                    </button>

                    {{-- Editar (solo si está pendiente de pago) --}}
                    @if ($reservation->status === 'pending_pay')
                        <button 
                            @click="$dispatch('open-modal-edit-reservation-{{ $reservation->id }}')" 
                            class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 transition" 
                            title="Editar"
                        >
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                    @endif

                    {{-- Icono PDF (solo si está pagado) --}}
                    @if ($reservation->status === 'paid')
                        <span class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 transition text-xl" title="PDF Comprobante">
                            <i class="bi bi-filetype-pdf"></i>
                        </span>
                    @endif
                </td>
            </tr>
        @endforeach
    </x-admin.table>

    {{-- Renderizar modales después de la tabla --}}
    @foreach ($reservations as $reservation)
        <x-client.modal-show-reservation :reservation="$reservation" />
        @if ($reservation->status === 'pending_pay')
            <x-client.modal-edit-reservation :reservation="$reservation" />
        @endif
    @endforeach
@endif





                

                <!-- Botón para abrir el modal -->
                <div class="mt-6 flex justify-end">
                    <a href="#" onclick="openReservationModal()" class="bg-white text-black py-2 px-4 rounded hover:bg-gray-200 transition text-sm sm:text-base">
                        Nueva Reservación
                    </a>
                </div>

                <!-- Modal -->
                <div id="reservationModal" class="hidden fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center p-4 sm:p-8">
                    <x-client.modal-reservation />
                </div>

                <!-- Script para abrir modal automáticamente -->
                <script>
                    function openReservationModal() {
                        document.getElementById('reservationModal').classList.remove('hidden');
                    }

                    window.addEventListener('DOMContentLoaded', () => {
                        if (localStorage.getItem('autoOpenReservationModal') === 'true') {
                            localStorage.removeItem('autoOpenReservationModal');
                            openReservationModal();
                        }
                    });
                </script>

            </div>
        </div>
    </div>
    <x-client.perfil :user="Auth::user()" />

</x-app-layout>
