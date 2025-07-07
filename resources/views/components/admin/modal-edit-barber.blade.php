@props(['barber', 'specialties'])

<div 
    x-data="{ showEditModal: false }"
    x-on:open-modal-edit-barber-{{ $barber->id }}.window="showEditModal = true"
    class="z-50"
>
    <!-- Modal -->
    <div 
        x-show="showEditModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
    >
        <div 
            @click.outside="showEditModal = false"
            class="bg-[#1E1E1E] text-white rounded-lg shadow-lg w-full max-w-3xl p-6 overflow-y-auto max-h-[90vh] custom-scroll"
        >
            <h2 class="text-xl font-semibold mb-4">Editar Barbero</h2>

            <form 
                action="{{ route('admin.barbers.update', $barber->id) }}" 
                method="POST" 
                enctype="multipart/form-data" 
                x-data="modalFormData()" 
                x-init="initBarberData(@json($barber->specialties->pluck('id')), @json($barber->specialties->pluck('name')))"
            >
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $barber->name) }}"
                           class="w-full mt-1 p-2 bg-[#2A2A2A] text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Apellido -->
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium">Apellido</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $barber->last_name) }}"
                           class="w-full mt-1 p-2 bg-[#2A2A2A] text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $barber->email) }}"
                           class="w-full mt-1 p-2 bg-[#2A2A2A] text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Teléfono -->
                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium">Teléfono</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $barber->phone_number) }}"
                           class="w-full mt-1 p-2 bg-[#2A2A2A] text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Especialidades -->
                <div class="mb-4 relative">
                    <label class="block text-sm font-medium mb-1 text-white">Especialidades (máx. 3)</label>

                    <button type="button" @click="toggle"
                        class="w-full px-4 py-2 bg-[#2A2A2A] border border-gray-600 rounded flex justify-between items-center">
                        <span x-text="selectedLabels.length ? selectedLabels.join(', ') : 'Seleccionar especialidades'"></span>
                        <i class="bi bi-chevron-down ml-2"></i>
                    </button>

                    <div x-show="open" @click.outside="open = false"
                        class="absolute z-50 mt-2 w-full bg-[#2A2A2A] border border-gray-600 rounded shadow-lg max-h-60 overflow-y-auto">
                        <div class="p-2 space-y-1">
                            @foreach ($specialties as $specialty)
                                @php
                                    $isSelected = in_array($specialty->id, $barber->specialties->pluck('id')->toArray());
                                @endphp
                                <label class="flex items-center space-x-2 px-2 py-1 hover:bg-white/10 rounded">
                                    <input type="checkbox"
                                        value="{{ $specialty->id }}"
                                        @change="updateSelection($event)"
                                        @if($isSelected) checked @endif
                                        data-label="{{ $specialty->name }}"
                                        class="text-indigo-500 bg-transparent border-gray-500 rounded focus:ring-0">
                                    <span>{{ $specialty->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="specialty_ids[]" :value="id">
                    </template>

                    <div x-show="warning" x-transition class="text-sm text-red-400 mt-2">
                        Solo puedes seleccionar hasta 3 especialidades.
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium">Descripción</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full mt-1 p-2 bg-[#2A2A2A] text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $barber->description) }}</textarea>
                </div>

                <!-- Foto -->
                <div class="mb-4">
                    <label for="profile_photo" class="block text-sm font-medium">Foto de perfil</label>
                    <input type="file" name="profile_photo" id="profile_photo" class="mt-1 text-white">
                    @if ($barber->profile_photo)
                        <img src="{{ asset('storage/' . $barber->profile_photo) }}" alt="Foto actual"
                             class="h-20 w-20 object-cover rounded mt-2 border border-gray-500">
                    @endif
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium">Contraseña (opcional)</label>
                    <input type="password" name="password" id="password"
                           class="w-full mt-1 p-2 bg-[#2A2A2A] text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full mt-1 p-2 bg-[#2A2A2A] text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit"
                            class="bg-white text-black font-semibold px-5 py-2 rounded-md hover:bg-gray-200 transition">
                        Actualizar
                    </button>
                    <button type="button" @click="showEditModal = false"
                            class="text-gray-400 hover:text-white transition">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Componente de errores -->
<x-utils.modal-error-edit-barber :barberId="$barber->id" />

<!-- Script -->
<script>
function modalFormData() {
    return {
        // Modal control
        open: false,
        selected: [],
        selectedLabels: [],
        warning: false,

        toggle() {
            this.open = !this.open;
        },

        updateSelection(event) {
            const id = parseInt(event.target.value);
            const label = event.target.dataset.label;

            if (event.target.checked) {
                if (this.selected.length < 3) {
                    if (!this.selected.includes(id)) {
                        this.selected.push(id);
                        this.selectedLabels.push(label);
                    }
                } else {
                    event.target.checked = false;
                    this.warning = true;
                    setTimeout(() => this.warning = false, 2500);
                }
            } else {
                this.selected = this.selected.filter(i => i !== id);
                this.selectedLabels = this.selectedLabels.filter(l => l !== label);
            }
        },

        initBarberData(ids = [], labels = []) {
            // Asignar los valores iniciales
            this.selected = Array.isArray(ids) ? [...ids] : [];
            this.selectedLabels = Array.isArray(labels) ? [...labels] : [];
        }
    }
}
</script>

<!-- Scrollbar personalizada -->
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
