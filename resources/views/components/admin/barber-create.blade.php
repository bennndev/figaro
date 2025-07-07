<div x-data="{ showCreateBarber: {{ $errors->any() ? 'true' : 'false' }} }" x-cloak>
    <!-- Botón para abrir modal -->
    <div class="mb-6 flex justify-end">
        <button 
            @click="showCreateBarber = true"
            class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition"
        >
            + Nuevo Barbero
        </button>
    </div>

    <!-- Modal -->
    <div 
        x-show="showCreateBarber"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
        style="display: none;"
    >
        <div @click.outside="showCreateBarber = false" class="bg-[#2A2A2A] text-white w-full max-w-3xl rounded-2xl shadow-2xl p-6 relative overflow-y-auto max-h-[90vh] custom-scroll">

            <!-- Botón cerrar -->
            <button 
                @click="showCreateBarber = false"
                class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl font-bold"
            >
                &times;
            </button>

            <h2 class="text-2xl font-bold mb-6">Crear Barbero</h2>

            <form action="{{ route('admin.barbers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium">Nombre:</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white">

                    </div>

                    <!-- Apellido -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium">Apellido:</label>
                        <input type="text" name="last_name" id="last_name" required value="{{ old('last_name') }}"
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white">

                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium">Email:</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white">

                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium">Teléfono:</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white">

                    </div>

                    <!-- Especialidades -->
                    <div x-data="multiselectDropdown()" class="relative w-full md:col-span-2">
                        <label class="block text-sm font-medium text-white mb-2">Especialidades:</label>

                        <button @click="toggle" type="button"
                            class="w-full bg-[#1E1E1E] text-white border border-gray-600 rounded-md px-4 py-2 flex justify-between items-center">
                            <span x-text="selectedLabels.length ? selectedLabels.join(', ') : 'Seleccionar especialidades'"></span>
                            <i class="bi bi-chevron-down ml-2"></i>
                        </button>

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

                        <template x-for="id in selected" :key="id">
                            <input type="hidden" name="specialty_ids[]" :value="id">
                        </template>


                    </div>

                    <!-- Descripción -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium">Descripción:</label>
                        <textarea name="description" id="description" rows="3" required
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white">{{ old('description') }}</textarea>

                    </div>

                    <!-- Foto -->
                    <div class="md:col-span-2">
                        <label for="profile_photo" class="block text-sm font-medium">Foto de perfil:</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="mt-1 text-white">

                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-medium">Contraseña:</label>
                        <input type="password" name="password" id="password" required
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white">

                    </div>

                    <!-- Confirmar contraseña -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium">Confirmar Contraseña:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white">
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="submit"
                        class="bg-white text-[#2A2A2A] font-semibold px-5 py-2 rounded-md hover:bg-gray-200 transition">
                        Guardar
                    </button>
                    <button type="button" @click="showCreateBarber = false"
                        class="text-white hover:underline">
                        Cancelar
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Esto reactiva el modal si hay errores con SweetAlert -->
    <x-utils.modal-error-create-barber />

   

    <!-- Estilo scrollbar -->
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
    <script>
    function multiselectDropdown() {
        return {
            open: false,
            selected: @json(array_map('intval', old('specialty_ids', []))),
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
                // Inicializa etiquetas desde valores seleccionados previamente
                const specialties = @json($specialties ?? []);
                this.selectedLabels = this.selected.map(id => {
                    const specialty = specialties.find(s => s.id === id);
                    return specialty ? specialty.name : '';
                }).filter(name => name !== '');
            }
        };
    }
    </script>

</div>
