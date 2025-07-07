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

                {{-- Filtro de estado --}}
                <form class="mb-6">
                    <div class="flex items-center gap-2 bg-[#2A2A2A] p-3 rounded-md w-full max-w-xs">
                        <i class="bi bi-funnel-fill text-white text-lg"></i>
                        <label for="reservationStatusFilter" class="text-white font-semibold">Estado:</label>
                        <select id="reservationStatusFilter" class="bg-[#1E1E1E] text-white rounded px-3 py-2 border border-gray-600 focus:outline-none focus:border-white w-full">
                            <option value="">Todas</option>
                            <option value="paid">Pagadas</option>
                            <option value="completed">Completadas</option>
                            <option value="pending_pay">Pendiente de pago</option>
                            <option value="cancelled">Canceladas</option>
                        </select>
                    </div>
                </form>

                

@if ($reservations->isEmpty())
    <p class="text-white">No tienes reservaciones registradas.</p>
    <div class="flex justify-end mb-4">
      <a href="#" onclick="openReservationModal()" class="bg-white text-black py-2 px-4 rounded hover:bg-gray-200 transition text-sm sm:text-base">
        Nueva Reservación
      </a>
    </div>
@else
<div class="flex justify-end mb-4">
      <a href="#" onclick="openReservationModal()" class="bg-white text-black py-2 px-4 rounded hover:bg-gray-200 transition text-sm sm:text-base">
        Nueva Reservación
      </a>
    </div>

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
            <tr class="hover:bg-[#FFFFFF]/20 transition reservation-row" data-status="{{ $reservation->status }}">
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
                    @elseif ($reservation->status === 'cancelled')
                        <span class="inline-block px-3 py-1 bg-gray-600 text-white text-sm font-semibold rounded-full">
                            Cancelado
                        </span>
                    @elseif ($reservation->status === 'completed')
                        <span class="inline-block px-3 py-1 bg-gray-600 text-white text-sm font-semibold rounded-full">
                            Completado
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
                        {{-- Cancelar (solo si está pendiente de pago) --}}
                        <form method="POST" action="{{ route('client.reservations.cancel', $reservation->id) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="button" class="text-white hover:text-red-500 transition" title="Cancelar" onclick="cancelarReserva(this)">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </form>
                    @endif

                    {{-- Icono PDF (solo si está pagado) --}}
                    @if ($reservation->status === 'paid')
                        <a href="{{ route('client.payments.report', $reservation->payment->id) }}" 
                           target="_blank"
                        class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 transition text-xl" title="PDF Comprobante">
                            <i class="bi bi-filetype-pdf"></i>
                        </a>
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
{{-- Botón para nueva reserva arriba a la derecha --}}
    





                
<!-- Modal -->
<div id="reservationModal"
     class="hidden fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center p-4 sm:p-8">
  <x-client.modal-reservation
    :specialties="$specialties"
    :services="$services"
    :barbers="$barbers"
  />
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

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const filter = document.getElementById('reservationStatusFilter');
    if (filter) {
      filter.addEventListener('change', function() {
        const status = this.value;
        document.querySelectorAll('.reservation-row').forEach(row => {
          if (!status || row.getAttribute('data-status') === status) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    }
    
    // Función para cancelar reserva con SweetAlert2
    window.cancelarReserva = function(button) {
      showConfirmAlert(
        '¿Cancelar reserva?',
        '¿Estás seguro que deseas cancelar esta reserva? Esta acción no se puede deshacer.',
        'Sí, cancelar',
        'No, mantener'
      ).then((result) => {
        if (result.isConfirmed) {
          // Enviar el formulario
          button.closest('form').submit();
        }
      });
    };
  });
</script>

</x-app-layout>
