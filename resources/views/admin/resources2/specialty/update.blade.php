<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Especialidad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.specialties.update', $specialty->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div style="margin-bottom: 20px;">
                            <label for="name">Nombre:</label><br>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $specialty->name) }}"
                                required
                                style="width: 100%; padding: 8px; margin-top: 5px;"
                            >
                            @error('name')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" style="padding: 10px 15px; background-color: #1e40af; color: white; border: none; cursor: pointer;">
                            Actualizar
                        </button>
                    </form>

                    <div style="margin-top: 20px;">
                        <a href="{{ route('admin.specialties.index') }}">← Volver al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
