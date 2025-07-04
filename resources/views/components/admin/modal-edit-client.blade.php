<!-- resources/views/components/admin/modal-edit-client.blade.php -->
@props(['client'])

<div 
    x-data="{ showEditModal: false }"
    x-on:open-modal-edit-{{ $client->id }}.window="showEditModal = true"
    class="z-50"
>
    <!-- Modal -->
    <div 
        x-show="showEditModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showEditModal = false"
            class="bg-white text-black rounded-lg shadow-lg w-full max-w-2xl p-6"
        >

            <h2 class="text-xl font-semibold mb-4">Editar Cliente</h2>

            <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block font-medium">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $client->name) }}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Apellido -->
                <div class="mb-4">
                    <label for="last_name" class="block font-medium">Apellido</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $client->last_name) }}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Teléfono -->
                <div class="mb-4">
                    <label for="phone_number" class="block font-medium">Teléfono</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $client->phone_number) }}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Foto de perfil -->
                <div class="mb-4">
                    <label for="profile_photo" class="block font-medium">Foto de perfil</label>
                    <input type="file" name="profile_photo" id="profile_photo" class="mt-1">
                    @if ($client->profile_photo)
                        <div class="mt-2">
                            <img src="{{ $client->profile_photo_url }}" alt="Foto actual"
                                 class="h-24 w-24 object-cover rounded">
                        </div>
                    @endif
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block font-medium">Contraseña</label>
                    <input type="password" name="password" id="password"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Confirmar contraseña -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md">
                        Actualizar
                    </button>
                    <button type="button" @click="showEditModal = false"
                            class="text-gray-600 hover:text-gray-900">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
