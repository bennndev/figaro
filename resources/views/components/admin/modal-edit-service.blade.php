@props(['service', 'specialties'])

<div 
    x-data="{ showEditServiceModal: false }"
    x-on:open-modal-edit-service-{{ $service->id }}.window="showEditServiceModal = true"
    class="z-50"
>
    <div 
        x-show="showEditServiceModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showEditServiceModal = false"
            class="bg-[#2A2A2A] text-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 overflow-y-auto max-h-[90vh] custom-scroll"
        >
            <h2 class="text-2xl font-bold mb-4">Editar Servicio</h2>

            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $service->name) }}"
                        class="w-full p-2 rounded-md bg-[#1E1E1E] border border-gray-600 text-white">
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Descripción</label>
                    <textarea name="description" rows="3"
                        class="w-full p-2 rounded-md bg-[#1E1E1E] border border-gray-600 text-white">{{ old('description', $service->description) }}</textarea>
                </div>

                <!-- Duración -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Duración (minutos)</label>
                    <input type="number" name="duration_minutes" min="1"
                        value="{{ old('duration_minutes', $service->duration_minutes) }}"
                        class="w-full p-2 rounded-md bg-[#1E1E1E] border border-gray-600 text-white">
                </div>

                <!-- Precio -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Precio</label>
                    <input type="number" step="0.01" min="0" name="price"
                        value="{{ old('price', $service->price) }}"
                        class="w-full p-2 rounded-md bg-[#1E1E1E] border border-gray-600 text-white">
                </div>

                <!-- Imagen -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Imagen</label>
                    @if($service->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="Imagen actual"
                                 class="rounded-xl border border-white/10 shadow object-cover w-48 h-48">
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="text-white mt-1">
                </div>

                <!-- Especialidades -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Especialidades</label>
                    <div class="space-y-1">
                        @foreach ($specialties as $specialty)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="specialties[]"
                                       value="{{ $specialty->id }}"
                                       {{ in_array($specialty->id, old('specialties', $service->specialties->pluck('id')->toArray())) ? 'checked' : '' }}
                                       class="text-indigo-500 bg-transparent border-gray-500 rounded focus:ring-0">
                                <span>{{ $specialty->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit"
                        class="bg-white text-[#2A2A2A] font-semibold px-4 py-2 rounded-md hover:bg-gray-200 transition">
                        Actualizar
                    </button>
                    <button type="button" @click="showEditServiceModal = false"
                        class="text-white hover:underline transition">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-utils.modal-error key="showEditServiceModal" />

<!-- Scroll personalizado oscuro -->
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
.custom-scroll {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
}
.custom-scroll:hover {
    scrollbar-color: rgba(255, 255, 255, 0.4) transparent;
}
</style>

