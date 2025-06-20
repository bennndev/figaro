<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('client.reservations.store') }}" method="POST">
                        @csrf

                        <div style="margin-bottom: 20px;">
                            <label for="reservation_date">Fecha de Reservación:</label><br>
                            <input
                                type="date"
                                id="reservation_date"
                                name="reservation_date"
                                value="{{ old('reservation_date') }}"
                                required
                                min="{{ date('Y-m-d') }}"
                                style="width: 100%; padding: 8px; margin-top: 5px;"
                            >
                            @error('reservation_date')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="reservation_time">Hora de Reservación:</label><br>
                            <input
                                type="time"
                                id="reservation_time"
                                name="reservation_time"
                                value="{{ old('reservation_time') }}"
                                required
                                style="width: 100%; padding: 8px; margin-top: 5px;"
                            >
                            @error('reservation_time')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="note">Notas adicionales:</label><br>
                            <textarea
                                id="note"
                                name="note"
                                style="width: 100%; padding: 8px; margin-top: 5px;"
                            >{{ old('note') }}</textarea>
                            @error('note')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Crear Reservación
                        </button>
                    </form>

                    <div style="margin-top: 20px;">
                        <a href="{{ route('client.reservations.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>