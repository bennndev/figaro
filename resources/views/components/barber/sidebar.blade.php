@php
    function isActiveBarber($routeName) {
        return request()->routeIs($routeName) 
            ? 'bg-white text-black font-semibold rounded-xl' 
            : 'hover:bg-white/10 rounded-lg';
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
        <a href="{{ route('barber.dashboard') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActiveBarber('barber.dashboard') }}">
            <i class="bi bi-house-door-fill mr-3 text-2xl"></i> Inicio
        </a>

        <a href="{{ route('barber.schedules.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActiveBarber('barber.schedules.index') }}">
            <i class="bi bi-calendar-check-fill mr-3 text-2xl"></i> Horarios
        </a>

        <a href="{{ route('barber.schedules.calendar') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActiveBarber('barber.schedules.calendar') }}">
            <i class="bi bi-calendar3 mr-3 text-2xl"></i> Calendario
        </a>

        <a href="{{ route('barber.reservations.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActiveBarber('barber.reservations.index') }}">
            <i class="bi bi-calendar2-check mr-3 text-2xl"></i> Reservas
        </a>

        <a href="{{ route('barber.payments.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActiveBarber('barber.payments.index') }}">
            <i class="bi bi-credit-card-fill mr-3 text-2xl"></i> Pagos
        </a>
    </div>  
</nav>
