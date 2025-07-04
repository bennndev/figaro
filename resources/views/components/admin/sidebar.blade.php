@php
    function isActive($routeName) {
        return request()->routeIs($routeName) 
            ? 'bg-white text-black font-semibold rounded-xl' 
            : 'hover:bg-white/10 rounded-lg';
    }
@endphp

<nav class="flex flex-col justify-between h-full text-white p-4 rounded-2xl shadow-xl text-sm">

    <!-- Logo o ícono superior -->
    

    <!-- Menú -->
    <div class="space-y-4">
        <div class="flex justify-center my-1 mb-4">
        <img src="{{ asset('images/imagen2.svg') }}" alt="Ícono"
             class="max-w-[100px] max-h-[100px] drop-shadow-xl">
    </div><br>
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-4 py-3 transition {{ isActive('admin.dashboard') }}">
            <i class="bi bi-house-door-fill mr-3 text-2xl"></i> Inicio
        </a>

        <a href="{{ route('admin.profile.edit') }}" 
           class="flex items-center px-4 py-3 transition {{ isActive('admin.profile.edit') }}">
            <i class="bi bi-person-circle mr-3 text-2xl"></i> Perfil
        </a>

        <a href="{{ route('admin.clients.index') }}" 
           class="flex items-center px-4 py-3 transition {{ isActive('admin.clients.index') }}">
            <i class="bi bi-people-fill mr-3 text-2xl"></i> Clientes
        </a>

        <a href="{{ route('admin.barbers.index') }}" 
           class="flex items-center px-4 py-3 transition {{ isActive('admin.barbers.index') }}">
            <i class="bi bi-scissors mr-3 text-2xl"></i> Barberos
        </a>

        <a href="{{ route('admin.specialties.index') }}" 
           class="flex items-center px-4 py-3 transition {{ isActive('admin.specialties.index') }}">
            <i class="bi bi-calendar-check-fill mr-3 text-2xl"></i> Especialidad
        </a>

        <a href="{{ route('admin.services.index') }}" 
           class="flex items-center px-4 py-3 transition {{ isActive('admin.services.index') }}">
            <i class="bi bi-bag-check-fill mr-3 text-2xl"></i> Servicios
        </a>

        <a href="{{ route('admin.schedules.index') }}" 
           class="flex items-center px-4 py-3 transition {{ isActive('admin.schedules.index') }}">
            <i class="bi bi-calendar-check-fill mr-3 text-2xl"></i> Horarios
        </a>
    </div>

    <!-- Cerrar sesión -->
    <div class="mt-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center px-4 py-3 rounded-xl bg-white text-black hover:bg-gray-200 transition">
                <i class="bi bi-box-arrow-right mr-3 text-2xl"></i> Cerrar sesión
            </button>
        </form>
    </div>
</nav>
