@props(['reservation'])

<div 
    x-data="{ showEditModal: false }"
    x-on:open-modal-edit-reservation-{{ $reservation->id }}.window="showEditModal = true"
    class="z-50"
>
    <div 
        x-show="showEditModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div @click.outside="showEditModal = false" class="bg-white text-black rounded-lg shadow-lg w-full max-w-2xl p-6">
            <h2 class="text-xl font-semibold mb-4">Editar Reserva</h2>

            <form action="{{ route('client.reservations.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="note" class="block font-medium">Notas adicionales</label>
                    <textarea 
                        name="note" 
                        id="note" 
                        rows="3" 
                        class="w-full mt-1 p-2 border border-gray-300 rounded"
                    >{{ old('note', $reservation->note) }}</textarea>

                    @error('note')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Actualizar
                    </button>
                    <button type="button" @click="showEditModal = false" class="text-gray-600 hover:text-gray-900">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
