<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" id="name" required value="{{ old('name', $client->name) }}" class="w-full mt-1 p-2 border">
                        @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Apellido --}}
                    <div class="mb-4">
                        <label for="last_name">Apellido:</label>
                        <input type="text" name="last_name" id="last_name" required value="{{ old('last_name', $client->last_name) }}" class="w-full mt-1 p-2 border">
                        @error('last_name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required value="{{ old('email', $client->email) }}" class="w-full mt-1 p-2 border">
                        @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Teléfono --}}
                    <div class="mb-4">
                        <label for="phone_number">Teléfono:</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $client->phone_number) }}" class="w-full mt-1 p-2 border">
                        @error('phone_number') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Foto de perfil --}}
                    <div class="mb-4">
                        <label for="profile_photo">Foto de perfil:</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="mt-1">
                        @error('profile_photo') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                        @if ($client->profile_photo)
                            <div class="mt-2">
                                <img src="{{ $client->profile_photo_url }}" alt="Foto actual" class="h-24 w-24 object-cover rounded">
                            </div>
                        @endif
                    </div>

                    {{-- Contraseña --}}
                    <div class="mb-4">
                        <label for="password">Contraseña (dejar en blanco para no cambiar):</label>
                        <input type="password" name="password" id="password" class="w-full mt-1 p-2 border">
                        @error('password') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Confirmar contraseña --}}
                    <div class="mb-4">
                        <label for="password_confirmation">Confirmar contraseña:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full mt-1 p-2 border">
                    </div>

                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Actualizar</button>
                </form>

                <div class="mt-4">
                    <a href="{{ route('admin.clients.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
