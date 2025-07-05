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
                    @error('name')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
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

    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Se encontraron errores',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                background: '#2A2A2A',
                color: 'white',
                iconColor: '#EF4444',
                confirmButtonColor: '#EF4444',
                confirmButtonText: 'Entendido',
                allowOutsideClick: false,
                customClass: {
                    popup: 'rounded-xl border border-white/10 shadow-lg',
                    confirmButton: 'text-white font-semibold px-4 py-2'
                }
            }).then(() => {
                // Aseguramos que el modal se mantenga abierto
                const root = document.querySelector('[x-data]');
                if (root && root.__x) {
                    root.__x.$data.showModal = true;
                }
            });
        });
    </script>
    @endif
</div>
