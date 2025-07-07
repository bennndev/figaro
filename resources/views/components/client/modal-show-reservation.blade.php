@props(['reservation'])

<div 
    x-data="{ showModal: false }"
    x-on:open-modal-show-reservation-{{ $reservation->id }}.window="showModal = true"
    class="z-50"
>
    <div 
        x-show="showModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4"
    >
        <div 
            @click.outside="showModal = false"
            class="bg-[#1E1E1E] text-white rounded-xl shadow-lg w-full max-w-2xl p-6 transition-all transform scale-100"
        >
            <h3 class="text-xl font-bold mb-4">Reservación #{{ $reservation->id }}</h3>

            <div class="mb-4">
                <strong>Estado:</strong>
                <span class="ml-2 px-3 py-1 rounded-full text-sm font-semibold
                    {{ $reservation->status === 'paid' ? 'bg-white text-[#2A2A2A]' : 
                       ($reservation->status === 'pending_pay' ? 'border border-white text-white' : 
                       ($reservation->status === 'completed' ? 'bg-gray-600 text-white' : 'bg-gray-600 text-white')) }}">
                    @if ($reservation->status === 'paid')
                        Pagado
                    @elseif ($reservation->status === 'pending_pay')
                        Pendiente
                    @elseif ($reservation->status === 'cancelled')
                        Cancelado
                    @elseif ($reservation->status === 'completed')
                        Completado
                    @endif
                </span>
            </div>

            <div class="mb-4">
                <strong>Fecha:</strong> {{ $reservation->reservation_date->format('d/m/Y') }}
            </div>

            <div class="mb-4">
                <strong>Hora:</strong> {{ $reservation->reservation_time->format('H:i') }}
            </div>

            @if($reservation->note)
                <div class="mb-4">
                    <strong>Notas:</strong> {{ $reservation->note }}
                </div>
            @endif

            <div class="mb-4">
                <strong>Barbero:</strong> {{ $reservation->barber->first_name }} {{ $reservation->barber->last_name }}
            </div>

            <div class="mb-4">
                <strong>Servicios:</strong>
                <ul class="list-disc ml-5">
                    @foreach($reservation->services as $service)
                        <li>{{ $service->name }} ({{ $service->duration }} min - S/. {{ $service->price }})</li>
                    @endforeach
                </ul>
            </div>

            <div class="text-sm text-gray-400 mt-4">
                <p><strong>Creada:</strong> {{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Actualizada:</strong> {{ $reservation->updated_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="mt-6 text-right">
                <button @click="showModal = false"
                    class="px-4 py-2 bg-white text-[#1E1E1E] rounded hover:bg-gray-200 transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
