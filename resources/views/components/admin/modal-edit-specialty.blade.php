@props(['specialty'])

<div 
    x-data="{ showEditSpecialtyModal: false }"
    x-on:open-modal-edit-specialty-{{ $specialty->id }}.window="showEditSpecialtyModal = true"
    class="z-50"
>
    <!-- Modal -->
    <div 
        x-show="showEditSpecialtyModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showEditSpecialtyModal = false"
            class="bg-white text-black rounded-lg shadow-lg w-full max-w-xl p-6"
        >
            <h3 class="text-xl font-semibold mb-4">
                Editar Especialidad
            </h3>

            <form action="{{ route('admin.specialties.update', $specialty->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block font-medium">Nombre</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $specialty->name) }}" 
                        required 
                        class="w-full mt-1 p-2 border border-gray-300 rounded"
                    >
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md">
                        Actualizar
                    </button>
                    <button type="button" @click="showEditSpecialtyModal = false" class="text-gray-600 hover:text-gray-900">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-utils.modal-error key="showEditSpecialtyModal" />
