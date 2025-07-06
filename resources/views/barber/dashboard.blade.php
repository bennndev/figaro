<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Dashboard - ¡Hola, {{ auth()->guard('barber')->user()->name }}!
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Mensaje de bienvenida y verificación de horarios --}}
            <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold">¡Bienvenido de vuelta!</h3>
                        <p class="text-gray-300 mt-1">
                            Hoy es {{ now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                        </p>
                    </div>
                    @if(!$hasSchedules)
                        <div class="bg-white text-black px-4 py-2 rounded-lg font-semibold">
                            <i class="bi bi-exclamation-triangle mr-2"></i>
                            <a href="{{ route('barber.schedules.index') }}" class="hover:underline">
                                Configura tus horarios
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Estadísticas principales de pagos --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total recaudado -->
                <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <i class="bi bi-cash-stack text-white text-5xl mr-4"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-300">Total Recaudado</p>
                            <p class="text-2xl font-semibold text-white">
                                S/. {{ number_format($dashboardData['payment_stats']['total_amount'], 2) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Este mes -->
                <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <i class="bi bi-calendar-month text-white text-5xl mr-4"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-300">Este Mes</p>
                            <p class="text-2xl font-semibold text-white">
                                S/. {{ number_format($dashboardData['payment_stats']['this_month_amount'], 2) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Reservas completadas -->
                <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <i class="bi bi-check-lg text-white text-5xl mr-4"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-300">Completadas</p>
                            <p class="text-2xl font-semibold text-white">
                                {{ $dashboardData['reservation_stats']['completed_reservations'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Promedio por servicio -->
                <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <i class="bi bi-graph-up text-white text-5xl mr-4"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-300">Promedio</p>
                            <p class="text-2xl font-semibold text-white">
                                S/. {{ number_format($dashboardData['payment_stats']['average_payment'], 2) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Próximas reservas --}}
                <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <i class="bi bi-calendar-event mr-2"></i>
                        Próximas Reservas
                    </h3>
                    
                    @if($dashboardData['upcoming_reservations']->count() > 0)
                        <div class="space-y-3">
                            @foreach($dashboardData['upcoming_reservations'] as $reservation)
                                <div class="bg-white text-black p-4 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold">{{ $reservation->user->name }} {{ $reservation->user->last_name }}</p>
                                            <p class="text-sm text-gray-600">
                                                {{ $reservation->reservation_date->format('d/m/Y') }} - 
                                                {{ $reservation->reservation_time->format('H:i') }}
                                            </p>
                                            <div class="mt-2">
                                                @foreach($reservation->services as $service)
                                                    <span class="inline-block bg-[#2A2A2A] text-white text-xs px-2 py-1 rounded mr-1">
                                                        {{ $service->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 rounded text-xs font-semibold
                                            {{ $reservation->status === 'paid' ? 'bg-[#2A2A2A] text-white' : 'bg-white text-black border-2 border-[#2A2A2A]' }}">
                                            {{ $reservation->status === 'paid' ? 'Pagado' : 'Pendiente' }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('barber.reservations.index') }}" 
                               class="text-white hover:text-gray-300 text-sm underline">
                                Ver todas las reservas →
                            </a>
                        </div>
                    @else
                        <p class="text-gray-400">No tienes reservas próximas.</p>
                    @endif
                </div>

                {{-- Servicios más populares --}}
                <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <i class="bi bi-star mr-2"></i>
                        Servicios Más Populares
                    </h3>
                    
                    @if($dashboardData['popular_services']->count() > 0)
                        <div class="space-y-3">
                            @foreach($dashboardData['popular_services'] as $service)
                                <div class="flex justify-between items-center bg-[#1E1E1E] text-white p-3 rounded-lg">
                                    <div>
                                        <p class="font-semibold text-white">{{ $service->name }}</p>
                                        <p class="text-sm text-gray-300">
                                            {{ $service->times_booked }} veces - 
                                            S/. {{ number_format($service->total_revenue, 2) }} total
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-white font-semibold">S/. {{ $service->price }}</p>
                                        <p class="text-xs text-gray-300">{{ $service->duration_minutes }} min</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400">No hay datos de servicios aún.</p>
                    @endif
                </div>
            </div>

            {{-- Actividad reciente --}}
            <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <i class="bi bi-clock-history mr-2"></i>
                    Actividad Reciente
                </h3>
                
                @if($dashboardData['recent_activity']->count() > 0)
                    <div class="space-y-3">
                        @foreach($dashboardData['recent_activity'] as $activity)
                            <div class="flex items-center bg-[#1E1E1E] text-white p-3 rounded-lg">
                                @if($activity['type'] === 'reservation')
                                    <i class="bi bi-calendar-event text-white text-2xl mr-4"></i>
                                    <div class="flex-1">
                                        <p class="font-semibold text-white">Nueva reserva</p>
                                        <p class="text-sm text-gray-300">
                                            {{ $activity['data']->user->name }} - 
                                            {{ $activity['data']->reservation_date->format('d/m/Y') }}
                                        </p>
                                    </div>
                                @else
                                    <i class="bi bi-credit-card text-white text-2xl mr-4"></i>
                                    <div class="flex-1">
                                        <p class="font-semibold text-white">Pago recibido</p>
                                        <p class="text-sm text-gray-300">
                                            S/. {{ number_format($activity['data']->amount / 100, 2) }} - 
                                            {{ $activity['data']->reservation->user->name }}
                                        </p>
                                    </div>
                                @endif
                                <span class="text-xs text-gray-400">
                                    {{ $activity['created_at']->diffForHumans() }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400">No hay actividad reciente.</p>
                @endif
            </div>

            {{-- Accesos rápidos --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('barber.reservations.index') }}" 
                   class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6 hover:bg-white hover:text-black transition block group">
                    <div class="flex items-center">
                        <i class="bi bi-calendar-event text-2xl mr-4"></i>
                        <div>
                            <h4 class="font-semibold">Mis Reservas</h4>
                            <p class="text-sm opacity-75">Gestionar reservas</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('barber.payments.index') }}" 
                   class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6 hover:bg-white hover:text-black transition block group">
                    <div class="flex items-center">
                        <i class="bi bi-credit-card text-2xl mr-4"></i>
                        <div>
                            <h4 class="font-semibold">Mis Pagos</h4>
                            <p class="text-sm opacity-75">Ver historial</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('barber.schedules.index') }}" 
                   class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg p-6 hover:bg-white hover:text-black transition block group">
                    <div class="flex items-center">
                        <i class="bi bi-calendar-check text-2xl mr-4"></i>
                        <div>
                            <h4 class="font-semibold">Mis Horarios</h4>
                            <p class="text-sm opacity-75">Configurar disponibilidad</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-barber-app-layout>
