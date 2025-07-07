<!-- resources/views/components/admin/modal-edit-client.blade.php -->
@props(['client'])

<div 
    x-data="{ showEditModal: false }"
    x-on:open-modal-edit-{{ $client->id }}.window="showEditModal = true"
    class="z-50"
>
    <!-- Fondo del modal -->
    <div 
        x-show="showEditModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
    >
        <div 
            @click.outside="showEditModal = false"
            class="bg-[#1E1E1E] text-white rounded-lg shadow-xl w-full max-w-2xl max-h-[85vh] overflow-y-auto scroll-smooth scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800 p-6"
        >
            <h2 class="text-xl font-semibold mb-4 text-white">Editar Cliente</h2>

            <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block font-medium text-sm">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $client->name) }}"
                        class="w-full mt-1 p-2 rounded-md bg-[#2A2A2A] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Apellido -->
                <div class="mb-4">
                    <label for="last_name" class="block font-medium text-sm">Apellido</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $client->last_name) }}"
                        class="w-full mt-1 p-2 rounded-md bg-[#2A2A2A] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block font-medium text-sm">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}"
                        class="w-full mt-1 p-2 rounded-md bg-[#2A2A2A] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Teléfono -->
                <div class="mb-4">
                    <label for="phone_number" class="block font-medium text-sm">Teléfono</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $client->phone_number) }}"
                        class="w-full mt-1 p-2 rounded-md bg-[#2A2A2A] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Foto de perfil -->
                <div class="mb-4">
                    <label for="profile_photo" class="block font-medium text-sm">Foto de perfil</label>
                    <input type="file" name="profile_photo" id="profile_photo" class="mt-1 text-white">
                    @if ($client->profile_photo)
                        <div class="mt-3">
                            <img src="{{ $client->profile_photo_url }}" alt="Foto actual"
                                 class="h-24 w-24 object-cover rounded-md border border-gray-500">
                        </div>
                    @endif
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block font-medium text-sm">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="w-full mt-1 p-2 rounded-md bg-[#2A2A2A] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Confirmar contraseña -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium text-sm">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full mt-1 p-2 rounded-md bg-[#2A2A2A] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit"
                        class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition">
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

<x-utils.modal-error key="showEditModal" />

<!-- Scrollbar personalizado -->
<style>
    [x-cloak] {
        display: none !important;
    }

    .scrollbar-thin::-webkit-scrollbar {
        width: 6px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
    }

    .scrollbar-thin:hover::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.4);
    }

    .scrollbar-thin {
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
    }

    .scrollbar-thin:hover {
        scrollbar-color: rgba(255, 255, 255, 0.4) transparent;
    }
</style>
