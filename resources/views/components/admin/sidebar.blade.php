@php
    function isActive($routeName) {
        return request()->routeIs($routeName) 
            ? 'bg-white text-black font-semibold rounded-xl' 
            : 'hover:bg-white/10 rounded-lg';
    }
@endphp

<nav class="flex flex-col justify-between h-full relative text-sm">
    {{-- Imagen/Ícono en la cabecera --}} 

    {{-- Opciones de menú --}}
    <div class="space-y-4 overflow-y-auto pr-2 scrollbar-hide" style="max-height:calc(100vh-140px);">
        <div class="flex justify-center my-1">
        <img src="{{ asset('images/imagen2.svg') }}" alt="Ícono"
             class="max-w-[100px] max-h-[100px] drop-shadow-xl  ">
</div><br>
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('admin.dashboard') }}">
            <i class="bi bi-house-door-fill mr-3 text-2xl"></i> Inicio
        </a>

        <a href="{{ route('admin.clients.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('admin.clients.index') }}">
            <i class="bi bi-people-fill mr-3 text-2xl"></i> Clientes
        </a>

        <a href="{{ route('admin.barbers.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('admin.barbers.index') }}">
            <i class="bi bi-scissors mr-3 text-2xl"></i> Barberos
        </a>

        <a href="{{ route('admin.specialties.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('admin.specialties.index') }}">
            <i class="bi bi-calendar-check-fill mr-3 text-2xl"></i> Especialidad
        </a>

        <a href="{{ route('admin.services.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('admin.services.index') }}">
            <i class="bi bi-bag-check-fill mr-3 text-2xl"></i> Servicios
        </a>

        <a href="{{ route('admin.schedules.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('admin.schedules.index') }}">
            <i class="bi bi-calendar-check-fill mr-3 text-2xl"></i> Horarios
        </a>

        <a href="{{ route('admin.schedules.calendar') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('admin.schedules.calendar') }}">
            <i class="bi bi-calendar3 mr-3 text-2xl"></i> Calendario
        </a>

        <a href="{{ route('admin.reservations.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('admin.reservations.index') }}">
            <i class="bi bi-calendar-check-fill mr-3 text-2xl"></i> Reservas
        </a>

        <a href="{{ route('admin.payments.index') }}"
           class="flex items-center px-4 py-3 rounded-xl transition {{ isActive('admin.payments.index') }}">
            <i class="bi bi-credit-card-fill mr-3 text-2xl"></i> Pagos
        </a>

    </div>
</nav>

<style>
/* Oculta la barra de scroll en todos los navegadores modernos */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;     /* Firefox */
}
</style>
