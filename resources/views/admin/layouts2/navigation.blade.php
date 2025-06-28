@php
    function isActive($routeName) {
        return request()->routeIs($routeName) ? 'bg-white text-black font-semibold' : 'hover:bg-white/10';
    }
@endphp

<nav class="flex flex-col justify-between h-full">
    {{-- Opciones de menú --}}
    <div class="space-y-3">
        <a href="{{ route('inicio') }}" 
           class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('inicio') }}">
            <i class="bi bi-house-door-fill mr-4 text-2xl"></i> Inicio
        </a>

        <a href="{{ route('perfil') }}"
            class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('perfil') }}">
             <i class="bi bi-person-circle mr-4 text-2xl"></i> Perfil
        </a>

        <a href="{{ route('usuarios') }}"
         class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('usuarios') }}">
            <i class="bi bi-people-fill mr-4 text-2xl"></i> Usuarios
        </a>

        <a href="{{ route('barberos') }}"
         class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('barberos') }}">
            <i class="bi bi-scissors mr-4 text-2xl"></i> Barberos
        </a>

        <a href="{{ route('servicios') }}"
         class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('servicios') }}">
            <i class="bi bi-bag-check-fill mr-4 text-2xl"></i> Servicios
        </a>

        <a href="{{ route('facturas') }}"
         class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('facturas') }}">
            <i class="bi bi-receipt-cutoff mr-4 text-2xl"></i> Facturas
        </a>

        <a href="{{ route('reservas') }}"
         class="flex items-center px-5 py-4 rounded text-xl transition {{ isActive('reservas') }}">
            <i class="bi bi-calendar-check-fill mr-4 text-2xl"></i> Reservas
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

