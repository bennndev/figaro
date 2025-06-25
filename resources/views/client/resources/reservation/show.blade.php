<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
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
                    <strong>Fecha:</strong>
                    <p>{{ $reservation->reservation_date->format('d/m/Y') }}</p>
                </div>

                <div class="mb-4">
                    <strong>Hora:</strong>
                    <p>{{ $reservation->reservation_time->format('H:i') }}</p>
                </div>

                @if($reservation->note)
                    <div class="mb-4">
                        <strong>Notas:</strong>
                        <p>{{ $reservation->note }}</p>
                    </div>
                @endif

                <div class="mb-4">
                    <strong>Barbero:</strong>
                    <p>{{ $reservation->barber->first_name }} {{ $reservation->barber->last_name }}</p>
                </div>

                <div class="mb-4">
                    <strong>Servicios:</strong>
                    <ul class="list-disc ml-6">
                        @foreach($reservation->services as $service)
                            <li>{{ $service->name }} ({{ $service->duration }} min - S/. {{ $service->price }})</li>
                        @endforeach
                    </ul>
                </div>

                <div class="text-sm text-gray-500">
                    <p><strong>Creada:</strong> {{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Actualizada:</strong> {{ $reservation->updated_at->format('d/m/Y H:i') }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('client.reservations.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                    @if($reservation->status === 'pending_pay')
                        | <a href="{{ route('client.reservations.edit', $reservation->id) }}" class="text-yellow-600 hover:underline">Editar nota</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
