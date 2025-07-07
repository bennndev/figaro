@props(['specialties'])

<div x-data="{ showServiceModal: {{ $errors->any() ? 'true' : 'false' }} }">
    <!-- BOTÓN ABRIR MODAL -->
    <button 
        @click="showServiceModal = true"
        class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition"
    >
        + Crear nuevo Servicio
    </button>

    <!-- MODAL -->
    <div 
        x-show="showServiceModal" 
        x-transition 
        x-cloak 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
    >
        <div class="bg-[#2A2A2A] text-white w-full max-w-2xl rounded-2xl shadow-2xl p-6 relative overflow-y-auto max-h-[90vh] custom-scroll">

            <!-- Botón cerrar -->
            <button 
                @click="showServiceModal = false"
                class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl font-bold"
            >
                &times;
            </button>

            <h2 class="text-2xl font-bold mb-6">Crear Servicio</h2>

            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium">Nombre:</label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}"
                        class="w-full px-3 py-2 border rounded bg-[#1F1F1F] border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-white/30">

                </div>

                <div>
                    <label for="description" class="block text-sm font-medium">Descripción:</label>
                    <textarea id="description" name="description" required
                        class="w-full px-3 py-2 border rounded bg-[#1F1F1F] border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-white/30">{{ old('description') }}</textarea>

                </div>

                <div>
                    <label for="image" class="block text-sm font-medium">Imagen:</label>
                    <input type="file" id="image" name="image" accept="image/*" required
                        class="text-white">

                </div>

                <div>
                    <label for="duration_minutes" class="block text-sm font-medium">Duración (min):</label>
                    <input type="number" id="duration_minutes" name="duration_minutes" min="1" required
                        value="{{ old('duration_minutes') }}"
                        class="w-full px-3 py-2 border rounded bg-[#1F1F1F] border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-white/30">

                </div>

                <div>
                    <label for="price" class="block text-sm font-medium">Precio:</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required
                        value="{{ old('price') }}"
                        class="w-full px-3 py-2 border rounded bg-[#1F1F1F] border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-white/30">

                </div>

                <!-- Especialidades -->
<div x-data="multiselectDropdown()" class="relative w-full">
    <label class="block text-sm font-medium text-white mb-2">Especialidades:</label>

    <!-- Botón -->
    <button @click="toggle" type="button"
        class="w-full bg-[#1F1F1F] text-white border border-gray-600 rounded-md px-4 py-2 flex justify-between items-center">
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

            </div>

             <div class="mt-6 flex justify-end">
                    <button type="submit"
                            class="bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-utils.modal-error key="showServiceModal" />






<script>
    function multiselectDropdown() {
        return {
            open: false,
            selected: @json(old('specialties', [])),
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
                // Recuperar etiquetas si hay error y old values
                const container = this.$el;
                this.selectedLabels = Array.from(container.querySelectorAll('input[type=checkbox]:checked'))
                    .map(cb => cb.nextElementSibling.innerText);
            }
        };
    }
</script>
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

