<section class="space-y-6">
    <header>
        <h3 class="text-lg font-semibold text-red-400 mb-2">Eliminar Cuenta</h3>
        <p class="text-sm text-gray-400">
            Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. 
            Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.
        </p>
    </header>

    <div class="bg-red-900/20 border border-red-500/30 rounded-lg p-4">
        <div class="flex items-start space-x-3">
            <i class="bi bi-exclamation-triangle-fill text-red-400 text-xl mt-1"></i>
            <div>
                <h4 class="text-red-400 font-medium mb-2">¡Advertencia!</h4>
                <p class="text-sm text-gray-300 mb-4">
                    Esta acción no se puede deshacer. Se eliminarán permanentemente:
                </p>
                <ul class="text-sm text-gray-300 space-y-1 mb-4">
                    <li>• Tu perfil y información personal</li>
                    <li>• Historial de reservas y citas</li>
                    <li>• Información de pagos</li>
                    <li>• Todas las preferencias guardadas</li>
                </ul>
            </div>
        </div>
    </div>

    <button x-data="{}"
            @click="$dispatch('open-modal', 'confirm-user-deletion')"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors flex items-center justify-center space-x-2">
        <i class="bi bi-trash"></i>
        <span>Eliminar Cuenta</span>
    </button>

    {{-- Modal de confirmación --}}
    <div x-data="{ show: false }"
         @open-modal.window="show = ($event.detail === 'confirm-user-deletion')"
         @close-modal.window="show = false"
         x-show="show"
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        
        {{-- Overlay --}}
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"
             @click="show = false"></div>
        
        {{-- Modal --}}
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-[#2A2A2A] rounded-xl shadow-xl max-w-md w-full border border-red-500/30"
                 @click.stop>
                
                {{-- Header --}}
                <div class="flex items-center justify-between p-6 border-b border-red-500/30">
                    <h3 class="text-lg font-semibold text-red-400">Confirmar Eliminación</h3>
                    <button @click="show = false"
                            class="text-gray-400 hover:text-white transition-colors">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                
                {{-- Contenido --}}
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')
                    
                    <div class="mb-6">
                        <p class="text-gray-300 mb-4">
                            ¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.
                        </p>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-white mb-2">
                                Para confirmar, ingresa tu contraseña:
                            </label>
                            <input id="password"
                                   name="password"
                                   type="password"
                                   class="block w-full bg-[#1F1F1F] text-white border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:border-red-500"
                                   placeholder="Contraseña"
                                   required>
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
                        </div>
                    </div>
                    
                    {{-- Botones --}}
                    <div class="flex justify-end space-x-3">
                        <button type="button"
                                @click="show = false"
                                class="px-4 py-2 text-gray-400 hover:text-white transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                            Eliminar Cuenta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
