@extends('layouts.app1')

@section('content')
<div class="min-h-screen bg-[#2A2A2A] text-white flex flex-col items-center justify-center py-10 px-4">
    <h2 class="text-3xl md:text-4xl font-bold mb-6">Reserva tu Cita</h2>

    {{-- Simulación de mensaje de confirmación --}}
    @if (session('ficticio'))
        <div class="mb-6 px-4 py-2 bg-green-600 text-white rounded">
            ✔️ Reserva enviada correctamente (ficticio, sin guardar en base de datos).
        </div>
    @endif

    <form method="POST" action="/citas/guardar" onsubmit="return mostrarMensaje()"
        class="w-full max-w-md bg-[#525252] p-6 rounded-lg shadow-md space-y-4">
        @csrf

        <div>
            <label class="block text-sm mb-1">Nombre completo</label>
            <input type="text" name="nombre" class="w-full px-3 py-2 rounded bg-[#2A2A2A] text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#787878]" placeholder="Ej. Juan Pérez" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Correo electrónico</label>
            <input type="email" name="email" class="w-full px-3 py-2 rounded bg-[#2A2A2A] text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#787878]" placeholder="ejemplo@correo.com" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Fecha</label>
            <input type="date" name="fecha" class="w-full px-3 py-2 rounded bg-[#2A2A2A] text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#787878]" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Hora</label>
            <input type="time" name="hora" class="w-full px-3 py-2 rounded bg-[#2A2A2A] text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#787878]" required>
        </div>

        <button type="submit" class="w-full bg-[#787878] hover:bg-[#FFFFFF] hover:text-[#2A2A2A] text-white font-semibold py-2 rounded transition duration-300">
            ✂️ Reservar
        </button>
    </form>
</div>

{{-- Script para mostrar el mensaje de forma ficticia --}}
<script>
    function mostrarMensaje() {
        alert("Reserva enviada correctamente.");
    }
</script>
@endsection
