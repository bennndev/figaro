<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Crear nuevo horario</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('admin.schedules.index') }}" class="text-white hover:underline">Volver a horarios</a>
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2A2A2A] shadow-sm sm:rounded-lg p-6 text-white border border-white/10">

                <form method="POST" action="{{ route('admin.schedules.store') }}">
                    @csrf

                    {{-- Nombre del horario --}}
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-white">Nombre del horario</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="mt-1 w-full border border-gray-600 rounded-md p-2 bg-[#1F1F1F] text-white focus:outline-none focus:border-blue-500"
                               required>
                        @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Barbero --}}
                    <div class="mb-5">
                        <label for="barber_id" class="block text-sm font-medium text-white">Barbero</label>
                        <select name="barber_id" id="barber_id"
                                class="mt-1 w-full border border-gray-600 rounded-md p-2 bg-[#1F1F1F] text-white focus:outline-none focus:border-blue-500"
                                required>
                            <option value="">Seleccione un barbero</option>
                            @foreach ($barbers as $barber)
                                <option value="{{ $barber->id }}" {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                                    {{ $barber->first_name }} {{ $barber->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('barber_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Fecha --}}
                    <div class="mb-5">
                        <label for="date" class="block text-sm font-medium text-white">Fecha</label>
                        <input type="date" name="date" id="date" value="{{ old('date') }}"
                               class="mt-1 w-full border border-gray-600 rounded-md p-2 bg-[#1F1F1F] text-white focus:outline-none focus:border-blue-500"
                               required>
                        @error('date') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Hora inicio --}}
                    <div class="mb-5">
                        <label for="start_time" class="block text-sm font-medium text-white">Hora de inicio</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                               class="mt-1 w-full border border-gray-600 rounded-md p-2 bg-[#1F1F1F] text-white focus:outline-none focus:border-blue-500"
                               required>
                        @error('start_time') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Hora fin --}}
                    <div class="mb-5">
                        <label for="end_time" class="block text-sm font-medium text-white">Hora de fin</label>
                        <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                               class="mt-1 w-full border border-gray-600 rounded-md p-2 bg-[#1F1F1F] text-white focus:outline-none focus:border-blue-500"
                               required>
                        @error('end_time') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Estado --}}
                    <div class="mb-5">
                        <label for="status" class="block text-sm font-medium text-white">Estado</label>
                        <select name="status" id="status"
                                class="mt-1 w-full border border-gray-600 rounded-md p-2 bg-[#1F1F1F] text-white focus:outline-none focus:border-blue-500"
                                required>
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                            <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>Reservado</option>
                        </select>
                        @error('status') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="mt-6 flex justify-end gap-4">
                        <button type="submit"
                                class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                            Guardar horario
                        </button>
                        <a href="{{ route('admin.schedules.index') }}"
                           class="text-white hover:underline">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin-app-layout>

s