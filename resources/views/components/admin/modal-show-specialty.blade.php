@props(['specialty'])

<div 
    x-data="{ showSpecialtyModal: false }"
    x-on:open-modal-show-specialty-{{ $specialty->id }}.window="showSpecialtyModal = true"
    class="z-50"
>
    <!-- Modal -->
    <div 
        x-show="showSpecialtyModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showSpecialtyModal = false"
            class="bg-[#2A2A2A] text-white rounded-lg shadow-lg w-full max-w-xl p-6"
        >
            <h3 class="text-xl font-semibold mb-4">
                Especialidad: {{ $specialty->name }}
            </h3>

            <ul class="list-disc pl-5 text-sm">
                <li><strong>Creado:</strong> {{ $specialty->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Actualizado:</strong> {{ $specialty->updated_at->format('d/m/Y H:i') }}</li>
            </ul>

            <div class="mt-6 flex justify-end">
                <button @click="showSpecialtyModal = false" class="text-gray-600 hover:text-gray-900">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
