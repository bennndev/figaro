<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-1">
            <span>Inicio</span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Bienvenida personalizada -->
            <div class="bg-gradient-to-r from-[#232526] to-[#414345] rounded-2xl shadow-lg mb-8 p-8 flex flex-col md:flex-row items-center gap-6">
                <img src="{{ asset('images/imagen.svg') }}" alt="Barbería" class="w-24 h-24 md:w-32 md:h-32 rounded-full shadow-lg border-4 border-[#222] bg-[#181818]">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-1">¡Hola, <span class="text-blue-400">{{ Auth::user()->name }}</span>!</h1>
                    <p class="text-lg text-gray-300">Bienvenido a <span class="font-bold text-blue-300">Figaro Barbería</span>. Reserva tu cita y disfruta de una experiencia única.</p>
                </div>
            </div>

            <!-- Próxima reserva -->
            @if($nextReservation)
            <div class="bg-[#232b3a]/80 border-l-4 border-blue-500 rounded-xl p-6 mb-10 flex flex-col md:flex-row items-center justify-between gap-4 shadow">
                <div>
                    <div class="font-semibold text-blue-300 mb-1 flex items-center gap-2">
                        <i class="bi bi-calendar-event text-xl"></i> Tu próxima reserva:
                    </div>
                    <div class="text-white text-lg font-bold">{{ $nextReservation->reservation_date->format('d/m/Y') }} a las {{ $nextReservation->reservation_time->format('H:i') }}</div>
                    <div class="text-gray-300 text-sm mt-1">Servicio(s): <span class="font-medium text-white">{{ $nextReservation->services->pluck('name')->join(', ') }}</span></div>
                    <div class="text-gray-300 text-sm">Barbero: <span class="font-medium text-white">{{ $nextReservation->barber->name ?? '-' }} {{ $nextReservation->barber->last_name ?? '' }}</span></div>
                </div>
                <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-semibold flex items-center gap-2 shadow">
                    <i class="bi bi-eye"></i> Ver detalles
                </a>
            </div>
            @endif

            <!-- Catálogo de servicios destacados -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2"><i class="bi bi-stars text-yellow-400"></i> Servicios más populares</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)
                        <div class="bg-[#232b3a]/80 rounded-2xl shadow-lg p-5 flex flex-col hover:scale-[1.025] transition-transform">
                            <img src="{{ $service->image_url ?? asset('images/default-service.jpg') }}" alt="{{ $service->name }}" class="w-full h-40 object-cover rounded-xl mb-4 border-2 border-[#222] bg-[#181818]">
                            <h3 class="text-lg font-bold text-white mb-1">{{ $service->name }}</h3>
                            <p class="text-gray-300 mb-2">{{ $service->description ?? 'Sin descripción.' }}</p>
                            @php $barber = $service->barbers->first(); @endphp
                            @if($barber)
                                <div class="flex items-center gap-2 mb-2">
                                    <img src="{{ $barber->profile_photo_url }}" class="w-8 h-8 rounded-full object-cover border-2 border-blue-400">
                                    <span class="text-sm text-blue-200">{{ $barber->name }} {{ $barber->last_name }}</span>
                                </div>
                            @endif
                            <form method="GET" action="{{ route('client.reservations.create') }}" class="mt-auto">
                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-400 text-white py-2 rounded-lg hover:from-blue-700 hover:to-blue-500 transition font-semibold flex items-center justify-center gap-2 mt-2 shadow">
                                    <i class="bi bi-calendar-plus"></i> Reservar
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Barberos destacados -->
            <div>
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2"><i class="bi bi-person-badge text-pink-400"></i> Barberos destacados</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($barbers as $barber)
                        <div class="bg-[#232b3a]/80 rounded-2xl shadow-lg p-6 flex flex-col items-center hover:scale-[1.025] transition-transform">
                            <img src="{{ $barber->profile_photo_url }}" alt="{{ $barber->name }}" class="w-20 h-20 rounded-full object-cover mb-3 border-2 border-pink-400 bg-[#181818]">
                            <h3 class="text-lg font-bold text-white mb-1">{{ $barber->name }} {{ $barber->last_name }}</h3>
                            <p class="text-gray-300 mb-3 text-center">{{ $barber->description ?? 'Barbero profesional.' }}</p>
                            <a href="#" class="bg-gradient-to-r from-pink-500 to-pink-400 text-white px-5 py-2 rounded-lg hover:from-pink-600 hover:to-pink-500 transition font-semibold mt-auto flex items-center gap-2 shadow">
                                <i class="bi bi-person-lines-fill"></i> Ver perfil
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <x-client.perfil :user="Auth::user()" />
</x-app-layout>
