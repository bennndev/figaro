@php
    function isActive($routeName) {
        return request()->routeIs($routeName) ? 'bg-white text-black font-semibold' : 'hover:bg-white/10';
    }
@endphp

<nav class="flex flex-col justify-between h-full relative text-sm">
    {{-- Imagen/Ícono en la cabecera --}}
    

    {{-- Opciones de menú --}}
    <div class="space-y-3">
        <div class="flex justify-center my-2">
    <img src="{{ asset('images/imagen.svg') }}" alt="Ícono"
         class="w-32 h-32 drop-shadow-xl">
</div>

        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-3 rounded transition {{ isActive('dashboard') }}">
            <i class="bi bi-speedometer2 mr-3 text-lg"></i> Dashboard
        </a>

        <a href="{{ route('client.reservations.index') }}"
           class="flex items-center px-4 py-3 rounded transition {{ isActive('client.reservations.index') }}">
            <i class="bi bi-calendar-check-fill mr-3 text-lg"></i> Reservas
        </a>

        <a href="{{ route('client.barbers.index') }}"
           class="flex items-center px-4 py-3 rounded transition {{ isActive('client.barbers.index') }}">
            <i class="bi bi-scissors mr-3 text-lg"></i> Barberos
        </a>

        <a href="{{ route('client.services.index') }}"
           class="flex items-center px-4 py-3 rounded transition {{ isActive('client.services.index') }}">
            <i class="bi bi-bag-check-fill mr-3 text-lg"></i> Servicios
        </a>
    </div>

    {{-- Botón de cerrar sesión --}}
    <div class="mt-6 px-4 mb-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 rounded bg-white text-black hover:bg-gray-200 transition text-sm">
                <i class="bi bi-box-arrow-right mr-3 text-lg"></i> Cerrar sesión
            </button>
        </form>
    </div>
</nav>
