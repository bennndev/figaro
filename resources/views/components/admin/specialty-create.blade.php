@props(['errors'])

<div x-data="{ showModal: {{ $errors->any() ? 'true' : 'false' }} }">
    <!-- BOTÓN ABRIR MODAL -->
    <button 
        @click="showModal = true"
        class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition"
    >
        + Crear nueva Especialidad
    </button>

    <!-- MODAL -->
    <div 
        x-show="showModal" 
        x-transition 
        x-cloak 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
        style="display: none;"
    >
        <div class="bg-[#2A2A2A] text-white w-full max-w-xl rounded-2xl shadow-2xl p-6 relative overflow-y-auto max-h-[90vh] custom-scroll">
            <!-- Botón cerrar -->
            <button 
                @click="showModal = false"
                class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl font-bold"
            >
                &times;
            </button>

            <!-- Título -->
            <h2 class="text-2xl font-bold mb-6">Crear Especialidad</h2>

            <!-- Formulario -->
            <form action="{{ route('admin.specialties.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-1">Nombre:</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full px-3 py-2 border border-white/20 rounded-md bg-[#1F1F1F] text-white focus:outline-none focus:ring-2 focus:ring-white/30"
                    >

                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                            class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
    </style>

    <!-- Componente de errores -->
    <x-utils.modal-error key="showModal" />
</div>
