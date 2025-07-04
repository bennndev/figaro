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
            <i class="bi bi-speedometer2 mr-3 text-xl"></i> Dashboard
        </a>

        <a href="{{ route('profile.edit') }}" 
           class="flex items-center px-4 py-3 transition {{ isActive('profile.edit') }}">
            <i class="bi bi-person-circle mr-3 text-2xl"></i> Perfil
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
    </div>

    {{-- Botón de cerrar sesión --}}
    <div class="mt-4 px-4 mb-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center px-4 py-3 rounded-xl bg-white text-black hover:bg-gray-200 transition text-sm">
                <i class="bi bi-box-arrow-right mr-3 text-2xl"></i> Cerrar sesión
            </button>
        </form>
    </div>
</nav>

