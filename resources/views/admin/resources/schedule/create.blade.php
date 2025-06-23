<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear nuevo horario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.schedules.store') }}">
                    @csrf

                    {{-- Nombre del horario --}}
                    <div style="margin-bottom: 20px;">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre del horario</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Barbero --}}
                    <div style="margin-bottom: 20px;">
                        <label for="barber_id" class="block text-sm font-medium text-gray-700">Barbero</label>
                        <select name="barber_id" id="barber_id"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                required>
                            <option value="">Seleccione un barbero</option>
                            @foreach ($barbers as $barber)
                                <option value="{{ $barber->id }}" {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                                    {{ $barber->first_name }} {{ $barber->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('barber_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Fecha --}}
                    <div style="margin-bottom: 20px;">
                        <label for="date" class="block text-sm font-medium text-gray-700">Fecha</label>
                        <input type="date" name="date" id="date" value="{{ old('date') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               required>
                        @error('date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Hora inicio --}}
                    <div style="margin-bottom: 20px;">
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Hora de inicio</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               required>
                        @error('start_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Hora fin --}}
                    <div style="margin-bottom: 20px;">
                        <label for="end_time" class="block text-sm font-medium text-gray-700">Hora de fin</label>
                        <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               required>
                        @error('end_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Estado --}}
                    <div style="margin-bottom: 20px;">
                        <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="status" id="status"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                required>
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                            <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>Reservado</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botón --}}
                    <div class="mt-6">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            Guardar horario
                        </button>
                        <a href="{{ route('admin.schedules.index') }}"
                           class="ml-4 text-gray-600 hover:underline">Cancelar</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-admin-app-layout>
s