@props(['barber', 'show'])

<!-- Overlay oscuro con desenfoque -->
<div x-show="{{ $show }}"
     x-transition.opacity
     class="fixed inset-0 z-40 flex items-center justify-center bg-black/50 backdrop-blur-md"
     style="display: none;">

    <!-- MODAL -->
    <div @click.away="{{ $show }} = false"
         class="relative z-50 w-full max-w-screen-lg mx-4 md:mx-auto rounded-xl shadow-2xl bg-[#a2a2a2] text-white p-8 overflow-y-auto max-h-[90vh]">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b border-white pb-3 mb-6">
            <h2 class="text-3xl font-bold">Detalle del Barbero</h2>
            <button @click="{{ $show }} = false"
                    class="text-white hover:text-gray-300 text-3xl font-bold">&times;</button>
        </div>

        <!-- Foto y nombre -->
        <div class="flex flex-col items-center">
            <img src="{{ asset('storage/' . $barber->profile_photo) }}"
                 class="w-36 h-36 object-cover rounded-full border border-white shadow mb-4">
            <h3 class="text-2xl font-bold">{{ $barber->name }} {{ $barber->last_name }}</h3>
            <p class="mt-4 text-center">{{ $barber->description }}</p>
        </div>

        <!-- Especialidades -->
        <div class="mt-6">
            <h4 class="text-lg font-semibold text-center mb-2">Especialidades</h4>
            <div class="flex flex-wrap justify-center gap-2">
                @forelse($barber->specialties as $specialty)
                    <span class="bg-white text-[#a2a2a2] font-semibold text-sm px-3 py-1 rounded-full">
                        {{ $specialty->name }}
                    </span>
                @empty
                    <p class="text-white text-sm">No tiene especialidades registradas.</p>
                @endforelse
            </div>
        </div>

        <!-- Contacto -->
        <div class="mt-6 text-center">
            <h4 class="text-md font-semibold mb-2">Contacto</h4>
            <p><strong>Email:</strong> {{ $barber->email }}</p>
            <p><strong>Teléfono:</strong> {{ $barber->phone_number }}</p>
        </div>

        <!-- Botón cerrar -->
        <div class="mt-8 text-center">
            <button @click="{{ $show }} = false"
                    class="bg-white text-[#a2a2a2] hover:bg-gray-100 font-bold px-6 py-2 rounded-lg">
                Cerrar
            </button>
        </div>
    </div>
</div>
