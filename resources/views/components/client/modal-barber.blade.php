<div x-show="showModal"
     x-transition
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-md"
     style="display: none;">

    <template x-if="selectedBarber">
        <div @click.away="showModal = false"
             class="w-full md:w-[950px] h-full md:h-[550px] rounded-xl shadow-2xl bg-[#2A2A2A] text-white overflow-hidden flex flex-col relative max-h-[90vh] mx-4">

            <!-- Header -->
            <div class="flex justify-between items-center px-6 py-4">
                <h2 class="text-2xl font-bold">Detalle del Barbero</h2>
                <button @click="showModal = false"
                        class="text-white hover:text-gray-300 text-3xl font-bold">&times;</button>
            </div>

            <!-- Cuerpo Responsive -->
            <div class="flex flex-col md:flex-row flex-grow overflow-y-auto max-h-[calc(90vh-130px)]">
                
                <!-- Imagen -->
                <div class="w-full md:w-1/2 h-64 md:h-full flex items-center justify-center bg-[#2A2A2A]">
                    <img :src="'/storage/' + selectedBarber.profile_photo"
                         class="h-48 md:h-[90%] aspect-square object-cover rounded-2xl shadow-lg border border-white/10" />
                </div>

                <!-- Contenido -->
                <div class="w-full md:w-1/2 px-6 py-6 flex flex-col items-start overflow-y-auto space-y-4">
                    <h3 class="text-2xl font-bold" x-text="selectedBarber.name + ' ' + selectedBarber.last_name"></h3>

                    <p class="text-white/90 text-lg leading-relaxed" x-text="selectedBarber.description"></p>

                    <div class="text-lg w-full">
                        <h4 class="font-semibold">Contacto</h4>
                        <p><strong>Email:</strong> <span x-text="selectedBarber.email"></span></p>
                        <p><strong>Teléfono:</strong> <span x-text="selectedBarber.phone_number"></span></p>
                    </div>
                </div>
            </div>

            <!-- Botón Reservar (fijo abajo) -->
            <div class="absolute bottom-5 left-0 right-0 px-6 flex justify-center md:justify-end">
                <a 
    href="{{ route('client.reservations.index') }}"
    onclick="localStorage.setItem('autoOpenReservationModal', 'true')"
    class="bg-white text-[#2A2A2A] hover:bg-gray-100 font-bold py-3 px-6 rounded-lg text-lg shadow-md transition w-full md:w-auto text-center"
>
    Realizar reserva
</a>

            </div>
        </div>
    </template>
</div>