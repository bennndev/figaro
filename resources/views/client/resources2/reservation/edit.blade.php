<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('client.reservations.update', $reservation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nota --}}
                    <div class="mb-4">
                        <label for="note">Notas adicionales:</label>
                        <textarea name="note" id="note" rows="3" class="w-full p-2 border rounded">{{ old('note', $reservation->note) }}</textarea>
                        @error('note')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white py-2 px-4 rounded">
                        Actualizar Reservación
                    </button>
                </form>

                <div class="mt-4">
                    <a href="{{ route('client.reservations.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
