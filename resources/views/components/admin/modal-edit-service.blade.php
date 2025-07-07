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
                <div x-data="multiselectDropdownEdit()" class="relative w-full mb-4">
                    <label class="block text-sm font-medium text-white mb-2">Especialidades:</label>

                    <!-- Botón -->
                    <button @click="toggle" type="button"
                        class="w-full bg-[#1E1E1E] text-white border border-gray-600 rounded-md px-4 py-2 flex justify-between items-center">
                        <span x-text="selectedLabels.length ? selectedLabels.join(', ') : 'Seleccionar especialidades'"></span>
                        <i class="bi bi-chevron-down ml-2"></i>
                    </button>

                    <!-- Lista desplegable -->
                    <div x-show="open" @click.outside="open = false"
                        class="absolute z-50 mt-2 w-full bg-[#2A2A2A] text-white rounded-md border border-gray-600 shadow-lg max-h-60 overflow-y-auto">
                        <div class="p-2 space-y-1">
                            @foreach ($specialties as $specialty)
                                <label class="flex items-center space-x-2 px-2 py-1 hover:bg-white/10 rounded">
                                    <input
                                        type="checkbox"
                                        value="{{ $specialty->id }}"
                                        @change="updateSelection($event)"
                                        x-bind:checked="selected.includes({{ $specialty->id }})"
                                        class="text-blue-500 bg-transparent border-gray-500 rounded focus:ring-0"
                                    >
                                    <span>{{ $specialty->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Campos ocultos -->
                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="specialties[]" :value="id">
                    </template>
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

<script>
    function multiselectDropdownEdit() {
        return {
            open: false,
            selected: @json(old('specialties', $service->specialties->pluck('id')->toArray())),
            selectedLabels: [],
            toggle() {
                this.open = !this.open;
            },
            updateSelection(event) {
                const id = parseInt(event.target.value);
                const label = event.target.nextElementSibling.innerText;

                if (event.target.checked) {
                    this.selected.push(id);
                    this.selectedLabels.push(label);
                } else {
                    this.selected = this.selected.filter(i => i !== id);
                    this.selectedLabels = this.selectedLabels.filter(l => l !== label);
                }
            },
            init() {
                // Recuperar etiquetas de las especialidades ya seleccionadas
                const specialtiesData = @json($specialties->keyBy('id')->map(function($specialty) { return $specialty->name; }));
                this.selectedLabels = this.selected.map(id => specialtiesData[id]).filter(name => name !== undefined);
            }
        };
    }
</script>

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

