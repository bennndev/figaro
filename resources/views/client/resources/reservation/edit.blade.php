<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('client.reservations.update', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div style="margin-bottom: 20px;">
                            <label for="note">Notas adicionales:</label><br>
                            <textarea
                                id="note"
                                name="note"
                                style="width: 100%; padding: 8px; margin-top: 5px;"
                            >{{ old('note', $reservation->note) }}</textarea>
                            @error('note')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Actualizar Reservación
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