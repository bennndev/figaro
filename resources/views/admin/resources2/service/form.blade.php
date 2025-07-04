<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div style="margin-bottom: 20px;">
                            <label for="name">Nombre:</label><br>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                style="width: 100%; padding: 8px; margin-top: 5px;"
                            >
                            @error('name')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="description">Descripción:</label><br>
                            <textarea
                                id="description"
                                name="description"
                                required
                                style="width: 100%; padding: 8px; margin-top: 5px;"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="image">Imagen:</label><br>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/*"
                                required
                                style="margin-top: 5px;"
                            >
                            @error('image')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="duration_minutes">Duración (minutos):</label><br>
                            <input
                                type="number"
                                id="duration_minutes"
                                name="duration_minutes"
                                value="{{ old('duration_minutes') }}"
                                min="1"
                                required
                                style="width: 100%; padding: 8px; margin-top: 5px;"
                            >
                            @error('duration_minutes')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="price">Precio:</label><br>
                            <input
                                type="number"
                                id="price"
                                name="price"
                                value="{{ old('price') }}"
                                step="0.01"
                                min="0"
                                required
                                style="width: 100%; padding: 8px; margin-top: 5px;"
                            >
                            @error('price')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo de especialidades --}}
                        <div style="margin-bottom: 20px;">
                            <label for="specialties">Especialidades:</label><br>
                            <select
                                id="specialties"
                                name="specialties[]"
                                multiple
                                required
                                style="width: 100%; padding: 8px; margin-top: 5px;"
                            >
                                @foreach ($specialties as $specialty)
                                    <option value="{{ $specialty->id }}" {{ in_array($specialty->id, old('specialties', [])) ? 'selected' : '' }}>
                                        {{ $specialty->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small style="color: #555;">Mantén presionada Ctrl (Windows) o Cmd (Mac) para seleccionar múltiples</small>
                            @error('specialties')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" style="padding: 10px 15px; background-color: #1e40af; color: white; border: none; cursor: pointer;">
                            Guardar
                        </button>
                    </form>

                    <div style="margin-top: 20px;">
                        <a href="{{ route('admin.services.index') }}">← Volver al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
