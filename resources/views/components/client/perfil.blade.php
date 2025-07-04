@props(['user'])

<div 
    x-data="{ showPerfil: false, activeTab: 'info' }" 
    x-on:open-profile-modal.window="showPerfil = true"
    class="relative z-[9999]"
>
    <!-- Modal principal -->
    <div
        x-show="showPerfil"
        x-transition
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm"
        x-cloak
    >
        <div class="bg-[#1F1F1F]/80 text-white w-[800px] rounded-2xl shadow-2xl relative p-8 max-h-[95vh]">

            <!-- Botón cerrar -->
            <button @click="showPerfil = false"
                class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl font-bold">
                &times;
            </button>

            <!-- Navegación de pestañas -->
            <div class="mb-6 flex border-b border-gray-700 space-x-6 pt-2">
                <button 
                    @click="activeTab = 'info'" 
                    :class="activeTab === 'info' ? 'border-b-2 border-white font-semibold' : 'text-white/70 hover:text-white'" 
                    class="pb-2"
                >
                    Información
                </button>
                <button 
                    @click="activeTab = 'password'" 
                    :class="activeTab === 'password' ? 'border-b-2 border-white font-semibold' : 'text-white/70 hover:text-white'" 
                    class="pb-2"
                >
                    Contraseña
                </button>
                <button 
                    @click="activeTab = 'delete'" 
                    :class="activeTab === 'delete' ? 'border-b-2 border-white font-semibold' : 'text-white/70 hover:text-white'" 
                    class="pb-2"
                >
                    Eliminar cuenta
                </button>
            </div>

            <!-- Contenido dinámico con altura fija -->
            <div class="h-[500px] overflow-y-auto pr-2 custom-scroll">
                <div x-show="activeTab === 'info'" x-transition>
                    @include('client.profile.partials.update-profile-information-form')
                </div>

                <div x-show="activeTab === 'password'" x-transition>
                    @include('client.profile.partials.update-password-form')
                </div>

                <div x-show="activeTab === 'delete'" x-transition>
                    @include('client.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scrollbar personalizado -->
<style>
    .custom-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
    }

    .custom-scroll:hover::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.4);
    }
</style>
