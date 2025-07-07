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
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
    >
        <div 
            @click.outside="showClientModal = false"
            class="bg-[#1F1F1F] text-white rounded-xl shadow-xl w-full max-w-2xl p-6 space-y-5 transition-all"
        >
            <h3 class="text-xl font-bold border-b border-white/10 pb-3">
                Cliente: {{ $client->name }} {{ $client->last_name }}
            </h3>

            <ul class="space-y-2 text-sm sm:text-base">
                <li><strong>Email:</strong> {{ $client->email }}</li>
                <li><strong>Teléfono:</strong> {{ $client->phone_number }}</li>
                <li><strong>Creado:</strong> {{ $client->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Actualizado:</strong> {{ $client->updated_at->format('d/m/Y H:i') }}</li>
            </ul>

            <div class="flex justify-center">
                <img src="{{ $client->profile_photo_url }}" alt="Foto de perfil"
                     class="h-36 w-36 object-cover rounded-md ring-2 ring-white/30 shadow-md">
            </div>

            <div class="flex justify-end">
                <button 
                    @click="showClientModal = false" 
                    class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition"
                >
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
