<div x-show="open" x-cloak x-transition
     class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
    <div @click.away="open = false"
         class="bg-[#2A2A2A] p-6 rounded-lg shadow-xl w-full max-w-md text-white">
        <h2 class="text-xl font-bold mb-4">Editar Perfil</h2>

        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nombres</label>
                <input type="text" class="w-full bg-[#1E1E1E] border border-gray-600 rounded px-4 py-2" value="Teodoro">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Apellidos</label>
                <input type="text" class="w-full bg-[#1E1E1E] border border-gray-600 rounded px-4 py-2" value="Admin">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Contraseña</label>
                <input type="password" class="w-full bg-[#1E1E1E] border border-gray-600 rounded px-4 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Confirmar Contraseña</label>
                <input type="password" class="w-full bg-[#1E1E1E] border border-gray-600 rounded px-4 py-2">
            </div>

            <div class="flex justify-end pt-2">
                <button type="button" @click="open = false"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded mr-2">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-white text-black hover:bg-gray-200 rounded font-semibold">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
