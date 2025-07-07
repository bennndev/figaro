@php
    function isActive($routeName) {
        return request()->routeIs($routeName) ? 'bg-white text-black font-semibold rounded-xl' : 'hover:bg-white/10 rounded-lg';
    }
@endphp

<nav class="flex flex-col justify-between h-full relative text-sm">
    {{-- Imagen/Ícono en la cabecera --}} 

    {{-- Opciones de menú --}}
    <div class="space-y-4">
        <div class="flex justify-center my-1">
        <img src="{{ asset('images/imagen2.svg') }}" alt="Ícono"
             class="max-w-[100px] max-h-[100px] drop-shadow-xl  ">
</div><br>
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('dashboard') }}">
            <i class="bi bi-house-door-fill mr-3 text-2xl"></i> Inicio
        </a>

        <a href="{{ route('client.reservations.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('client.reservations.index') }}">
            <i class="bi bi-calendar-check-fill mr-3 text-2xl"></i> Reservas
        </a>

        <a href="{{ route('client.barbers.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('client.barbers.index') }}">
            <i class="bi bi-scissors mr-3 text-2xl"></i> Barberos
        </a>

        <a href="{{ route('client.services.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('client.services.index') }}">
            <i class="bi bi-bag-check-fill mr-3 text-2xl"></i> Servicios
        </a>

        <a href="{{ route('client.payments.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('client.payments.index') }}">
            <i class="bi bi-credit-card-fill mr-3 text-2xl"></i> Pagos
        </a>

        <a href="{{ route('client.payments.history') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('client.payments.history') }}">
            <i class="bi bi-clock-history mr-3 text-2xl"></i> Historial de Pagos
        </a>
    </div>
</nav>

