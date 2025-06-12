<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Reservación #{{ $reservation->id }}</h3>

                <div class="mb-4">
                    <strong>Estado:</strong>
                    <span class="ml-2 px-2 py-1 rounded {{ 
                        $reservation->status === 'paid' ? 'bg-green-200' : 
                        ($reservation->status === 'pending_pay' ? 'bg-yellow-200' : 
                        ($reservation->status === 'completed' ? 'bg-blue-200' : 'bg-red-200')) 
                    }}">
                        @switch($reservation->status)
                            @case('pending_pay')
                                Pendiente de Pago
                                @break
                            @case('paid')
                                Pagado
                                @break
                            @case('cancelled')
                                Cancelado
                                @break
                            @case('completed')
                                Completado
                                @break
                        @endswitch
                    </span>
                </div>

                <div class="mb-4">
                    <strong>Fecha de Reservación:</strong>
                    <p>{{ $reservation->reservation_date->format('d/m/Y') }}</p>
                </div>

                <div class="mb-4">
                    <strong>Hora de Reservación:</strong>
                    <p>{{ $reservation->reservation_time->format('H:i') }}</p>
                </div>

                @if($reservation->note)
                    <div class="mb-4">
                        <strong>Notas adicionales:</strong>
                        <p>{{ $reservation->note }}</p>
                    </div>
                @endif

                <ul class="list-disc pl-5">
                    <li><strong>Creada:</strong> {{ $reservation->created_at->format('d/m/Y H:i') }}</li>
                    <li><strong>Actualizada:</strong> {{ $reservation->updated_at->format('d/m/Y H:i') }}</li>
                </ul>

                <div class="mt-6 space-x-4">
                    <a href="{{ route('client.reservations.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                    
                    @if($reservation->status === 'pending_pay')
                        <a href="{{ route('client.reservations.edit', $reservation->id) }}" class="text-yellow-600 hover:underline">Editar descripción</a>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>