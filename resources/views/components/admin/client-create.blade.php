<div x-data="{ showCreateClient: false }" x-cloak>
    <!-- Botón para abrir el modal -->
    <div class="mb-6 flex justify-end">
        <button 
            @click="showCreateClient = true"
            class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition"
        >
            + Nuevo Cliente
        </button>
    </div>

    <!-- Modal -->
    <div 
        x-show="showCreateClient"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
        style="display: none;"
    >
        <div class="bg-[#2A2A2A] text-white w-full max-w-2xl rounded-2xl shadow-2xl p-6 relative overflow-y-auto max-h-[90vh] custom-scroll">

            <!-- Botón cerrar -->
            <button 
                @click="showCreateClient = false"
                class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl font-bold"
            >
                &times;
            </button>

            <h2 class="text-2xl font-bold mb-4">Crear Cliente</h2>

            <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium">Nombre:</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white text-sm">
                        @error('name') <div class="text-red-400 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Apellido -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium">Apellido:</label>
                        <input type="text" name="last_name" id="last_name" required value="{{ old('last_name') }}"
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white text-sm">
                        @error('last_name') <div class="text-red-400 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium">Email:</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white text-sm">
                        @error('email') <div class="text-red-400 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium">Teléfono:</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white text-sm">
                        @error('phone_number') <div class="text-red-400 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-medium">Contraseña:</label>
                        <input type="password" name="password" id="password" required
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white text-sm">
                        @error('password') <div class="text-red-400 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Confirmar contraseña -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium">Confirmar Contraseña:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="mt-1 w-full border rounded-md p-2 bg-[#1E1E1E] text-white text-sm">
                    </div>

                    <!-- Foto de perfil (ocupa toda la fila) -->
                    <div class="sm:col-span-2">
                        <label for="profile_photo" class="block text-sm font-medium">Foto de perfil:</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="mt-1 text-white text-sm">
                        @error('profile_photo') <div class="text-red-400 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="bg-white text-[#2A2A2A] font-semibold px-5 py-2 rounded-md hover:bg-gray-200 transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scrollbar personalizado -->
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

        /* Firefox */
        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
        }

        .custom-scroll:hover {
            scrollbar-color: rgba(255, 255, 255, 0.4) transparent;
        }
    </style>
</div>
