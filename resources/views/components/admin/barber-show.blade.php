<div 
    x-data="{ show: false, barber: {} }"
    x-show="show"
    @open-barber-detail.window="barber = $event.detail; show = true"
    x-cloak
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;"
>
    <div class="bg-[#2A2A2A] text-white w-full max-w-2xl rounded-2xl shadow-2xl p-6 relative overflow-y-auto max-h-[90vh] custom-scroll">

        <!-- Botón cerrar -->
        <button 
            @click="show = false"
            class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl font-bold"
        >
            &times;
        </button>

        <h2 class="text-2xl font-bold mb-4">Detalle de Barbero</h2>

        <template x-if="barber.name">
            <div>
                <h3 class="text-lg font-semibold mb-4" x-text="'Barbero ' + barber.name + ' ' + barber.last_name"></h3>

                <ul class="list-disc pl-5 space-y-2 text-white/90">
                    <li><strong>Email:</strong> <span x-text="barber.email"></span></li>
                    <li><strong>Teléfono:</strong> <span x-text="barber.phone_number"></span></li>
                    <li><strong>Descripción:</strong> <span x-text="barber.description || 'Sin descripción'"></span></li>
                    <li><strong>Especialidades:</strong>
                        <ul class="list-inside list-disc ml-4 mt-1" x-show="barber.specialties && barber.specialties.length">
                            <template x-for="s in barber.specialties" :key="s.id">
                                <li x-text="s.name"></li>
                            </template>
                        </ul>
                        <span class="text-gray-400" x-show="!barber.specialties || !barber.specialties.length">
                            Sin especialidades registradas
                        </span>
                    </li>
                    <li><strong>Creado:</strong> <span x-text="barber.created_at"></span></li>
                    <li><strong>Actualizado:</strong> <span x-text="barber.updated_at"></span></li>
                </ul>

                <div class="mt-6 flex justify-center" x-show="barber.profile_photo">
                    <img :src="'/storage/' + barber.profile_photo" alt="Foto de perfil"
                        class="h-40 w-40 object-cover rounded-lg shadow border border-white/10">
                </div>

                <div class="mt-6 text-right">
                    <button @click="show = false" class="text-blue-400 hover:underline">← Cerrar</button>
                </div>
            </div>
        </template>
    </div>

    <style>
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .custom-scroll:hover::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.4);
        }
    </style>
</div>
