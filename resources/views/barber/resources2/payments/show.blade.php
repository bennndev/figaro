<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Detalle de Pago</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('barber.payments.index') }}" class="text-[#FFFFFF] flex items-center">
                <span>Pagos</span>
            </a>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Pago {{ $payment->id }}</h3>

                <div class="mb-4">
                    <strong>Estado del Pago:</strong>
                    <span class="ml-2 px-2 py-1 rounded 
                        {{ $payment->status === 'complete' ? 'bg-green-600 text-white' : 
                           ($payment->status === 'open' ? 'bg-yellow-600 text-white' : 'bg-red-600 text-white') }}">
                        @if($payment->status === 'complete')
                            Completado
                        @elseif($payment->status === 'open')
                            Abierto
                        @else
                            {{ ucfirst($payment->status) }}
                        @endif
                    </span>
                </div>

                <div class="mb-4">
                    <strong>Monto:</strong>
                    <p class="text-green-400 text-xl font-semibold">S/. {{ number_format($payment->amount / 100, 2) }}</p>
                </div>

                <div class="mb-4">
                    <strong>Cliente:</strong>
                    <p class="text-gray-300">{{ $payment->reservation->user->name ?? 'N/A' }} {{ $payment->reservation->user->last_name ?? '' }}</p>
                </div>

                <div class="mb-4">
                    <strong>Reserva Asociada:</strong>
                    <p class="text-gray-300">
                        Reserva {{ $payment->reservation->id }}
                        <br>
                        <span class="text-sm">
                            {{ $payment->reservation->reservation_date->format('d/m/Y') }} a las 
                            {{ $payment->reservation->reservation_time->format('H:i') }}
                        </span>
                    </p>
                </div>

                <div class="mb-4">
                    <strong>Servicios:</strong>
                    <ul class="list-disc ml-6 text-gray-300">
                        @foreach($payment->reservation->services as $service)
                            <li>{{ $service->name }} ({{ $service->duration_minutes }} min - S/. {{ $service->price }})</li>
                        @endforeach
                    </ul>
                </div>

                @if($payment->stripe_payment_intent_id)
                    <div class="mb-4">
                        <strong>ID de Payment Intent:</strong>
                        <p class="text-gray-300 font-mono text-sm">{{ $payment->stripe_payment_intent_id }}</p>
                    </div>
                @endif

                <div class="text-sm text-gray-400">
                    <p><strong>Pago procesado:</strong> {{ $payment->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Última actualización:</strong> {{ $payment->updated_at->format('d/m/Y H:i') }}</p>
                </div>

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('barber.payments.index') }}" class="bg-white text-black px-4 py-2 rounded hover:bg-gray-200 transition">
                        ← Volver al listado
                    </a>
                    
                    <a href="{{ route('barber.reservations.show', $payment->reservation->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Ver Reserva
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-barber-app-layout>
