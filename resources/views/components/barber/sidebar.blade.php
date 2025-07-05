@php
    function isActiveBarber($routeName) {
        return request()->routeIs($routeName) 
            ? 'bg-white text-black font-semibold rounded-xl' 
            : 'hover:bg-white/10 rounded-lg';
    }
@endphp

<nav class="flex flex-col justify-between h-full text-white p-4 rounded-2xl shadow-xl text-sm">

   

    <!-- Enlaces -->
    <div class="space-y-4">
        <div class="flex justify-center mb-6">
        <img src="{{ asset('images/imagen2.svg') }}" alt="Ícono" class="max-w-[100px] max-h-[100px] drop-shadow-xl">
    </div>
        <a href="{{ route('barber.dashboard') }}" 
           class="flex items-center px-4 py-3 transition {{ isActiveBarber('barber.dashboard') }}">
            <i class="bi bi-house-door-fill mr-3 text-2xl"></i> Inicio
        </a>
<a href="{{ route('barber.profile.edit') }}" 
           class="flex items-center px-4 py-3 transition {{ isActiveBarber('barber.profile.edit') }}">
            <i class="bi bi-person-circle mr-3 text-2xl"></i> Perfil
        </a>
        <a href="{{ route('barber.schedules.index') }}" 
           class="flex items-center px-4 py-3 transition {{ isActiveBarber('barber.schedules.index') }}">
            <i class="bi bi-calendar-check-fill mr-3 text-2xl"></i> Horarios
        </a>

        
    </div>

    <!-- Cerrar sesión -->
    <div class="mt-6">
        <form method="POST" action="{{ route('barber.logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center px-4 py-3 rounded-xl bg-white text-black hover:bg-gray-200 transition">
                <i class="bi bi-box-arrow-right mr-3 text-2xl"></i> Cerrar sesión
            </button>
        </form>
    </div>
</nav>
