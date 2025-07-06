<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Detalle de Reserva</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('barber.reservations.index') }}" class="text-[#FFFFFF] flex items-center">
                <span>Reservas</span>
            </a>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Reservación #{{ $reservation->id }}</h3>

                <div class="mb-4">
                    <strong>Estado:</strong>
                    <span class="ml-2 px-2 py-1 rounded 
                        {{ $reservation->status === 'paid' ? 'bg-green-600 text-white' : 
                           ($reservation->status === 'pending_pay' ? 'bg-yellow-600 text-white' : 
                           ($reservation->status === 'completed' ? 'bg-blue-600 text-white' : 
                           ($reservation->status === 'cancelled' ? 'bg-red-600 text-white' : 'bg-gray-600 text-white'))) }}">
                        @if($reservation->status === 'paid')
                            {{ __('validation.reservation_status.paid') }}
                        @elseif($reservation->status === 'pending_pay')
                            {{ __('validation.reservation_status.pending_pay') }}
                        @elseif($reservation->status === 'cancelled')
                            {{ __('validation.reservation_status.cancelled') }}
                        @elseif($reservation->status === 'completed')
                            {{ __('validation.reservation_status.completed') }}
                        @else
                            {{ ucfirst($reservation->status) }}
                        @endif
                    </span>
                </div>

                <div class="mb-4">
                    <strong>Cliente:</strong>
                    <p class="text-gray-300">{{ $reservation->user->name ?? 'N/A' }} {{ $reservation->user->last_name ?? '' }}</p>
                </div>

                <div class="mb-4">
                    <strong>Fecha:</strong>
                    <p class="text-gray-300">{{ $reservation->reservation_date->format('d/m/Y') }}</p>
                </div>

                <div class="mb-4">
                    <strong>Hora:</strong>
                    <p class="text-gray-300">{{ $reservation->reservation_time->format('H:i') }}</p>
                </div>

                @if($reservation->note)
                    <div class="mb-4">
                        <strong>Notas:</strong>
                        <p class="text-gray-300">{{ $reservation->note }}</p>
                    </div>
                @endif

                <div class="mb-4">
                    <strong>Servicios:</strong>
                    <ul class="list-disc ml-6 text-gray-300">
                        @foreach($reservation->services as $service)
                            <li>{{ $service->name }} ({{ $service->duration_minutes }} min - S/. {{ $service->price }})</li>
                        @endforeach
                    </ul>
                </div>

                <div class="text-sm text-gray-400">
                    <p><strong>Creada:</strong> {{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Actualizada:</strong> {{ $reservation->updated_at->format('d/m/Y H:i') }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('barber.reservations.index') }}" class="bg-white text-black px-4 py-2 rounded hover:bg-gray-200 transition">
                        ← Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-barber-app-layout>
