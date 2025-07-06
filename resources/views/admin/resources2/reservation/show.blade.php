<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
                <span>Detalle de Reserva #{!! $reservation->id !!}</span>
                <span class="mx-2 text-white">/</span>
                <a href="{{ route('admin.reservations.index') }}" class="text-[#FFFFFF] flex items-center">
                    <span>Reservas</span>
                </a>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow-sm sm:rounded-lg p-6 text-white">

                {{-- Mensaje de éxito --}}
                @if (session('success'))
                    <p class="text-green-400 mb-4">
                        {{ session('success') }}
                    </p>
                @endif

                {{-- Estado y acciones rápidas --}}
                <div class="bg-[#1F1F1F] rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Estado de la Reserva</h3>
                            @if($reservation->status === 'pending')
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-md bg-yellow-600 text-white">
                                    Pendiente
                                </span>
                            @elseif($reservation->status === 'paid')
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-md bg-blue-600 text-white">
                                    Pagado
                                </span>
                            @elseif($reservation->status === 'completed')
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-md bg-green-600 text-white">
                                    Completado
                                </span>
                            @elseif($reservation->status === 'cancelled')
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-md bg-red-600 text-white">
                                    Cancelado
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Información general --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    
                    {{-- Información del cliente --}}
                    <div class="bg-[#1F1F1F] rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Información del Cliente</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-300">Nombre:</span>
                                <p class="text-sm text-white">{{ $reservation->user->name }} {{ $reservation->user->last_name }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-300">Email:</span>
                                <p class="text-sm text-white">{{ $reservation->user->email }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-300">Teléfono:</span>
                                <p class="text-sm text-white">{{ $reservation->user->phone ?? 'No especificado' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Información del barbero --}}
                    <div class="bg-[#1F1F1F] rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Información del Barbero</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-300">Nombre:</span>
                                <p class="text-sm text-white">{{ $reservation->barber->name }} {{ $reservation->barber->last_name }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-300">Email:</span>
                                <p class="text-sm text-white">{{ $reservation->barber->email }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-300">Especialidades:</span>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach($reservation->barber->specialties as $specialty)
                                        <span class="inline-block bg-gray-600 text-white text-xs px-2 py-1 rounded">
                                            {{ $specialty->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Detalles de la cita --}}
                <div class="bg-[#1F1F1F] rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Detalles de la Cita</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <span class="text-sm font-medium text-gray-300">Fecha:</span>
                            <p class="text-sm text-white">{{ $reservation->reservation_date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-300">Hora:</span>
                            <p class="text-sm text-white">{{ $reservation->reservation_time->format('H:i') }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-300">Duración estimada:</span>
                            <p class="text-sm text-white">{{ $reservation->services->sum('duration') }} minutos</p>
                        </div>
                    </div>
                </div>

                {{-- Servicios --}}
                <div class="bg-[#1F1F1F] rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Servicios Solicitados</h3>
                    @if($reservation->services->count() > 0)
                        <div class="space-y-3">
                            @foreach($reservation->services as $service)
                                <div class="flex justify-between items-center p-3 bg-[#2A2A2A] rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-white">{{ $service->name }}</h4>
                                        <p class="text-sm text-gray-300">{{ $service->description }}</p>
                                        <p class="text-sm text-gray-400">Duración: {{ $service->duration }} minutos</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-white">S/. {{ number_format($service->price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="border-t border-gray-600 pt-3">
                                <div class="flex justify-between items-center font-semibold text-white">
                                    <span>Total:</span>
                                    <span>S/. {{ number_format($reservation->services->sum('price'), 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-400">No hay servicios asociados a esta reserva.</p>
                    @endif
                </div>

                {{-- Información del pago --}}
                <div class="bg-[#1F1F1F] rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Información del Pago</h3>
                    @if($reservation->payment)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <span class="text-sm font-medium text-gray-300">Monto:</span>
                                <p class="text-sm text-white">S/. {{ number_format($reservation->payment->amount / 100, 2) }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-300">Estado del pago:</span>
                                <p class="text-sm text-white">{{ ucfirst($reservation->payment->status) }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-300">Fecha del pago:</span>
                                <p class="text-sm text-white">
                                    {{ $reservation->payment->created_at ? $reservation->payment->created_at->format('d/m/Y H:i') : 'No disponible' }}
                                </p>
                            </div>
                        </div>
                        
                        @if($reservation->payment->stripe_payment_intent_id)
                            <div class="mt-4">
                                <span class="text-sm font-medium text-gray-300">ID de transacción:</span>
                                <p class="text-sm text-white font-mono">{{ substr($reservation->payment->stripe_payment_intent_id, 0, 20) }}...</p>
                            </div>
                        @endif
                    @else
                        <p class="text-gray-400">No hay información de pago disponible para esta reserva.</p>
                    @endif
                </div>

                {{-- Observaciones/Notas (si existe el campo) --}}
                @if(isset($reservation->notes) && $reservation->notes)
                    <div class="bg-[#1F1F1F] rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Observaciones</h3>
                        <p class="text-sm text-white">{{ $reservation->notes }}</p>
                    </div>
                @endif

                {{-- Timestamps --}}
                <div class="bg-[#1F1F1F] rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Información del Sistema</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <span class="text-sm font-medium text-gray-300">Fecha de creación:</span>
                            <p class="text-sm text-white">{{ $reservation->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-300">Última actualización:</span>
                            <p class="text-sm text-white">{{ $reservation->updated_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Botón volver --}}
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admin.reservations.index') }}" 
                       class="bg-white text-[#2A2A2A] px-4 py-2 rounded-md text-sm font-semibold hover:bg-gray-200 transition">
                        ← Volver al listado
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-admin-app-layout>
