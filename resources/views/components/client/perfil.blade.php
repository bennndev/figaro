<div x-data="{ 
    open: false, 
    activeTab: 'info' 
}" 
     @open-profile-modal.window="open = true" 
     x-show="open" 
     x-cloak 
     class="fixed inset-0 z-50 overflow-y-auto" 
     style="display: none;">
    
    {{-- Overlay --}}
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" 
         @click="open = false"></div>
    
    {{-- Modal --}}
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-[#2A2A2A]/80 rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-hidden border border-white/10"
             @click.stop>
            
            {{-- Header del modal --}}
            <div class="flex items-center justify-between p-6 border-b border-white/10">
                <h2 class="text-xl font-semibold text-white">Perfil del Cliente</h2>
                <button @click="open = false" 
                        class="text-gray-400 hover:text-white transition-colors">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            {{-- Navegación de pestañas --}}
            <div class="flex border-b border-white/10">
                <button @click="activeTab = 'info'" 
                        :class="activeTab === 'info' ? 'border-white text-white' : 'border-transparent text-gray-400 hover:text-white'"
                        class="flex-1 py-3 px-4 text-sm font-medium border-b-2 transition-colors">
                    <i class="bi bi-person mr-2"></i>Información
                </button>
                <button @click="activeTab = 'password'" 
                        :class="activeTab === 'password' ? 'border-white text-white' : 'border-transparent text-gray-400 hover:text-white'"
                        class="flex-1 py-3 px-4 text-sm font-medium border-b-2 transition-colors">
                    <i class="bi bi-lock mr-2"></i>Contraseña
                </button>
                <button @click="activeTab = 'delete'" 
                        :class="activeTab === 'delete' ? 'border-red-500 text-red-400' : 'border-transparent text-gray-400 hover:text-white'"
                        class="flex-1 py-3 px-4 text-sm font-medium border-b-2 transition-colors">
                    <i class="bi bi-trash mr-2"></i>Eliminar cuenta
                </button>
            </div>
            
            {{-- Contenido del modal --}}
            <div class="p-6 overflow-y-auto max-h-[60vh]" style="scrollbar-width: thin; scrollbar-color: #4B5563 #1F2937;">
                
                {{-- Pestaña de información --}}
                <div x-show="activeTab === 'info'" x-transition>
                    @include('client.profile.partials.update-profile-information-form')
                </div>
                
                {{-- Pestaña de contraseña --}}
                <div x-show="activeTab === 'password'" x-transition>
                    @include('client.profile.partials.update-password-form')
                </div>
                
                {{-- Pestaña de eliminar cuenta --}}
                <div x-show="activeTab === 'delete'" x-transition>
                    @include('client.profile.partials.delete-user-form')
                </div>
                
            </div>
        </div>
    </div>
</div>

<style>
    /* Scrollbar personalizado para el modal */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #1F2937;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #4B5563;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #6B7280;
    }
</style>
