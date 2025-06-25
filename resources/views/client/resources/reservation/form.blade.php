<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('client.reservations.store') }}" method="POST">
                    @csrf

                    {{-- Fecha --}}
                    <div class="mb-4">
                        <label for="reservation_date">Fecha:</label>
                        <input type="date" name="reservation_date" id="reservation_date"
                            value="{{ old('reservation_date') }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full p-2 border rounded" required>
                        @error('reservation_date')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Hora --}}
                    <div class="mb-4">
                        <label for="reservation_time">Hora:</label>
                        <input type="time" name="reservation_time" id="reservation_time"
                            value="{{ old('reservation_time') }}"
                            class="w-full p-2 border rounded" required>
                        @error('reservation_time')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Barbero --}}
                    <div class="mb-4">
                        <label for="barber_id">Selecciona un barbero:</label>
                        <select name="barber_id" id="barber_id" class="w-full p-2 border rounded" required>
                            <option value="">-- Elige un barbero --</option>
                            @foreach($barbers as $barber)
                                <option value="{{ $barber->id }}" {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                                    {{ $barber->first_name }} {{ $barber->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('barber_id')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Servicios --}}
                    <div class="mb-4">
                        <label>Servicios:</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                            @foreach($services as $service)
                                <label class="border p-4 rounded cursor-pointer hover:bg-gray-100">
                                    <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                        {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                                        class="mr-2">
                                    <strong>{{ $service->name }}</strong><br>
                                    <small class="text-gray-600">{{ $service->duration }} min - S/. {{ $service->price }}</small>
                                </label>
                            @endforeach
                        </div>
                        @error('services')
                            <div class="text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nota --}}
                    <div class="mb-4">
                        <label for="note">Notas adicionales:</label>
                        <textarea name="note" id="note" rows="3" class="w-full p-2 border rounded">{{ old('note') }}</textarea>
                        @error('note')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Botón --}}
                    <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white py-2 px-4 rounded">
                        Crear Reservación
                    </button>
                </form>

                <div class="mt-4">
                    <a href="{{ route('client.reservations.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
