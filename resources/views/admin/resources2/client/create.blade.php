<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}" class="w-full mt-1 p-2 border">
                        @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Apellido --}}
                    <div class="mb-4">
                        <label for="last_name">Apellido:</label>
                        <input type="text" name="last_name" id="last_name" required value="{{ old('last_name') }}" class="w-full mt-1 p-2 border">
                        @error('last_name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}" class="w-full mt-1 p-2 border">
                        @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Teléfono --}}
                    <div class="mb-4">
                        <label for="phone_number">Teléfono:</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="w-full mt-1 p-2 border">
                        @error('phone_number') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Foto de perfil --}}
                    <div class="mb-4">
                        <label for="profile_photo">Foto de perfil:</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="mt-1">
                        @error('profile_photo') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div class="mb-4">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" id="password" required class="w-full mt-1 p-2 border">
                        @error('password') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Confirmar contraseña --}}
                    <div class="mb-4">
                        <label for="password_confirmation">Confirmar contraseña:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full mt-1 p-2 border">
                    </div>

                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Guardar</button>
                </form>

                <div class="mt-4">
                    <a href="{{ route('admin.clients.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
