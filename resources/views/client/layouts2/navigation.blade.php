@php
    function isActive($routeName) {
        return request()->routeIs($routeName) ? 'bg-white text-black font-semibold' : 'hover:bg-white/10';
    }
@endphp

<nav class="flex flex-col justify-between h-full">
    {{-- Opciones de menú --}}
    <div class="space-y-3">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('dashboard') }}">
            <i class="bi bi-speedometer2 mr-4 text-2xl"></i> Dashboard
        </a>

        <a href="{{ route('client.reservations.index') }}"
           class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('client.reservations.index') }}">
            <i class="bi bi-calendar-check-fill mr-4 text-2xl"></i> Reservas
        </a>

        <a href="{{ route('client.barbers.index') }}"
           class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('client.barbers.index') }}">
            <i class="bi bi-scissors mr-4 text-2xl"></i> Barberos
        </a>

        <a href="{{ route('client.services.index') }}"
           class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('client.services.index') }}">
            <i class="bi bi-bag-check-fill mr-4 text-2xl"></i> Servicios
        </a>
    </div>

    {{-- Botón de cerrar sesión --}}
    <div class="mt-8">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-5 py-4 rounded bg-white text-black hover:bg-gray-200 text-xl transition">
                <i class="bi bi-box-arrow-right mr-4 text-2xl"></i> Cerrar sesión
            </button>
        </form>
    </div>
</nav>
