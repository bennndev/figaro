<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservar cita') }}
        </h2>
    </x-slot>

    <div class="py-12 text-center">
        <button onclick="document.getElementById('reservationModal').classList.remove('hidden')"
                class="bg-blue-600 hover:bg-blue-800 text-white py-3 px-6 rounded-xl shadow-lg">
            Nueva Reserva
        </button>
    </div>

    <x-client.modal-reservation />
</x-app-layout>
