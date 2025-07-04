<!-- Fondo desenfocado oscuro -->
<div x-show="showServiceModal"
     x-transition.opacity
     class="fixed inset-0 z-[9998] bg-black/50 backdrop-blur-sm"
     x-cloak>
</div>

<!-- Modal del servicio -->
<div x-show="showServiceModal"
     x-transition
     class="fixed inset-0 z-[9999] flex items-center justify-center px-4"
     x-cloak>

  <template x-if="selectedService">
    <div @click.away="showServiceModal = false"
         class="w-full max-w-4xl mx-auto rounded-2xl shadow-2xl bg-[#2A2A2A]/90 text-white backdrop-blur-md p-6 md:p-8 overflow-hidden max-h-[90vh] relative">

      <!-- Header -->
      <div class="flex justify-between items-center pb-3 mb-6 border-b border-white/10">
        <h2 class="text-2xl md:text-3xl font-bold">Detalle del Servicio</h2>
        <button @click="showServiceModal = false"
                class="text-white hover:text-gray-300 text-3xl font-bold">&times;</button>
      </div>

      <!-- Contenido con scroll -->
      <div class="overflow-y-auto max-h-[calc(90vh-130px)] pr-1 md:pr-2">
        <div class="flex flex-col md:flex-row gap-6 md:gap-8 pb-24">
          
          <!-- Imagen -->
          <div class="w-full md:w-1/2">
            <img :src="'/storage/' + selectedService.image"
                 alt="Imagen del servicio"
                 class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg border border-white/10">
          </div>

          <!-- Detalles -->
          <div class="w-full md:w-1/2">
            <h3 class="text-2xl md:text-3xl font-bold mb-4" x-text="selectedService.name"></h3>

            <div class="bg-white/10 rounded-lg p-4 mb-6 border border-white/10">
              <div class="flex justify-between items-center gap-4 flex-wrap">
                <div>
                  <span class="block text-sm text-white/80">Duración</span>
                  <span class="text-lg md:text-xl font-semibold"
                        x-text="selectedService.duration_minutes + ' min'"></span>
                </div>
                <div class="text-right">
                  <span class="block text-sm text-white/80">Precio</span>
                  <span class="text-xl md:text-2xl font-bold text-green-400"
                        x-text="'S/. ' + Number(selectedService.price).toFixed(2)"></span>
                </div>
              </div>
            </div>

            <div>
              <h4 class="text-lg md:text-xl font-semibold mb-2">Descripción</h4>
              <p class="text-white/90 text-base md:text-lg leading-relaxed"
                 x-text="selectedService.description"></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Botón fijo -->
      <div class="absolute bottom-5 right-0 left-0 px-6 flex justify-center md:justify-end">
        <a href="/client/reservations"
           onclick="localStorage.setItem('autoOpenReservationModal', 'true')"
           class="bg-white text-[#2A2A2A] hover:bg-gray-100 font-bold py-3 px-6 rounded-lg text-lg shadow-lg transition w-full md:w-auto text-center">
          Reservar este servicio
        </a>
      </div>
    </div>
  </template>
</div>
