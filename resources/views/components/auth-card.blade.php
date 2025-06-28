<div class="group bg-[#2A2A2A]/50 relative glass rounded-xl border border-gray-300 px-6 py-16 w-full max-w-md text-white shadow-xl hover:scale-105 duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white px-5 py-6 text-left block">
    <!-- Ícono centrado arriba del card -->
    <img src="{{ asset('images/imagen.svg') }}" alt="Ícono"
         class="absolute -top-32 left-1/2 transform -translate-x-1/2 w-40 h-40 drop-shadow-xl z-10">

    {{ $slot }}
</div>
