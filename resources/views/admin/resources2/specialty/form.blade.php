<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Crear Especialidad</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('admin.specialties.index') }}" class="text-[#FFFFFF] hover:underline flex items-center">
                <span>Listado</span>
            </a>
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2A2A2A] text-white shadow-xl sm:rounded-xl p-6">
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

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('admin.specialties.index') }}"
                           class="bg-white text-[#2A2A2A] font-semibold px-4 py-2 rounded hover:bg-white/80 transition">
                            ← Cancelar
                        </a>

                        <button type="submit"
                                class="bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-app-layout>
