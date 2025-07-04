<!-- resources/views/components/admin/modal-show-client.blade.php -->
@props(['client'])

<div 
    x-data="{ showClientModal: false }"
    x-on:open-modal-show-{{ $client->id }}.window="showClientModal = true"
    class="z-50"
>
    <!-- Modal -->
    <div 
        x-show="showClientModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showClientModal = false"
            class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 text-black"
        >
            <h3 class="text-lg font-bold mb-4">
                Cliente {{ $client->name }} {{ $client->last_name }}
            </h3>

            <ul class="list-disc pl-5">
                <li><strong>Email:</strong> {{ $client->email }}</li>
                <li><strong>Teléfono:</strong> {{ $client->phone_number }}</li>
                <li><strong>Creado:</strong> {{ $client->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Actualizado:</strong> {{ $client->updated_at->format('d/m/Y H:i') }}</li>
            </ul>

            <div class="mt-6">
                <img src="{{ $client->profile_photo_url }}" alt="Foto de perfil"
                     class="h-36 w-36 object-cover rounded-md">
            </div>

            <div class="mt-6 flex justify-end">
                <button @click="showClientModal = false" class="text-gray-600 hover:text-gray-900">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
