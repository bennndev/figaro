@props(['reservation'])

<div 
    x-data="{ showModal: false }"
    x-on:open-modal-show-reservation-{{ $reservation->id }}.window="showModal = true"
    class="z-50"
>
    <div 
        x-show="showModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div @click.outside="showModal = false" class="bg-white text-black rounded-lg shadow-lg w-full max-w-2xl p-6">

            <h3 class="text-lg font-bold mb-4">Reservación #{{ $reservation->id }}</h3>

            <div class="mb-4">
                <strong>Estado:</strong>
                <span class="ml-2 px-2 py-1 rounded 
                    {{ $reservation->status === 'paid' ? 'bg-green-200' : 
                       ($reservation->status === 'pending_pay' ? 'bg-yellow-200' : 
                       ($reservation->status === 'completed' ? 'bg-blue-200' : 'bg-red-200')) }}">
                    {{ ucfirst($reservation->status) }}
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

            <div class="text-sm text-gray-500">
                <p><strong>Creada:</strong> {{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Actualizada:</strong> {{ $reservation->updated_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="mt-6 text-right">
                <button @click="showModal = false" class="text-gray-600 hover:text-gray-900">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
