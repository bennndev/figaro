@extends('layouts.app1')

@section('content')
<div class="min-h-screen bg-[#2A2A2A] text-white flex flex-col items-center justify-center text-center px-4 relative overflow-hidden">
    
    {{-- Imagen de fondo difuminada --}}
    <img src="/images/fondo-barberia.jpg" class="absolute inset-0 w-full h-full object-cover opacity-30 blur-sm" alt="Fondo barbería">

    {{-- Contenido principal encima de la imagen --}}
    <div class="relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Bienvenido a <span class="text-[#FFFFFF]">El Rincón del Barbero</span></h1>
        <p class="text-lg md:text-xl mb-8 max-w-xl">Tu estilo comienza aquí. Reserva tu cita con nuestros mejores barberos y transforma tu look.</p>

        <div class="flex flex-col md:flex-row gap-4 justify-center mt-6">
            <a href="/reservar" class="inline-block text-center bg-[#525252] hover:bg-[#787878] text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300">
                ✂️ Reservar ahora
            </a>

            <a href="/login" class="inline-block text-center bg-[#525252] hover:bg-[#787878] text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300">
                🔐 Iniciar sesión
            </a>

            <a href="/register" class="inline-block text-center bg-[#525252] hover:bg-[#787878] text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300">
                📝 Registrarse
            </a>
        </div>

        <footer class="mt-12 text-sm text-gray-300">
            © 2025 El Rincón del Barbero
        </footer>
    </div>
</div>
@endsection
