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
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showEditModal = false"
            class="bg-white text-black rounded-lg shadow-lg w-full max-w-3xl p-6 overflow-y-auto max-h-[90vh]"
        >
            <h2 class="text-xl font-semibold mb-4">Editar Barbero</h2>

            <form action="{{ route('admin.barbers.update', $barber->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block font-medium">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $barber->name) }}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Apellido -->
                <div class="mb-4">
                    <label for="last_name" class="block font-medium">Apellido</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $barber->last_name) }}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $barber->email) }}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Teléfono -->
                <div class="mb-4">
                    <label for="phone_number" class="block font-medium">Teléfono</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $barber->phone_number) }}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Especialidades -->
                <div class="mb-4">
                    <label for="specialties" class="block font-medium">Especialidades</label>
                    <select name="specialties[]" id="specialties" multiple
                            class="w-full mt-1 p-2 border border-gray-300 rounded">
                        @foreach ($specialties as $specialty)
                            <option value="{{ $specialty->id }}"
                                {{ in_array($specialty->id, old('specialties', $barber->specialties->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $specialty->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="description" class="block font-medium">Descripción</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full mt-1 p-2 border border-gray-300 rounded">{{ old('description', $barber->description) }}</textarea>
                </div>

                <!-- Foto -->
                <div class="mb-4">
                    <label for="profile_photo" class="block font-medium">Foto de perfil</label>
                    <input type="file" name="profile_photo" id="profile_photo" class="mt-1">
                    @if ($barber->profile_photo)
                        <img src="{{ asset('storage/' . $barber->profile_photo) }}" alt="Foto actual"
                             class="h-20 w-20 object-cover rounded mt-2">
                    @endif
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block font-medium">Contraseña (opcional)</label>
                    <input type="password" name="password" id="password"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md">
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
