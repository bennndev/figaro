@props(['title', 'id', 'modalVariable' => 'showModal', 'eventName'])

<div 
    x-data="{ {{ $modalVariable }}: false }"
    x-on:{{ $eventName }}.window="{{ $modalVariable }} = true"
    class="z-50"
>
    <!-- Modal -->
    <div 
        x-show="{{ $modalVariable }}"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
        style="display: none;"
    >
        <div 
            @click.outside="{{ $modalVariable }} = false" 
            class="bg-[#2A2A2A] text-white w-full max-w-3xl rounded-2xl shadow-2xl p-6 relative overflow-y-auto max-h-[90vh] custom-scroll"
        >
            <!-- Botón cerrar -->
            <button 
                @click="{{ $modalVariable }} = false"
                class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl font-bold"
            >
                &times;
            </button>

            <!-- Título con icono -->
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <i class="bi bi-eye mr-2"></i>{{ $title }}
            </h2>

            <!-- Contenido del modal -->
            <div class="space-y-4">
                {{ $slot }}
            </div>

            <!-- Botón de cerrar inferior -->
            <div class="mt-6 flex justify-end">
                <button 
                    @click="{{ $modalVariable }} = false"
                    class="px-4 py-2 bg-white text-[#2A2A2A] font-semibold rounded-md hover:bg-gray-200 transition"
                >
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <!-- Estilo scrollbar -->
    <style>
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .custom-scroll:hover::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.4);
        }
        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
        }
        .custom-scroll:hover {
            scrollbar-color: rgba(255, 255, 255, 0.4) transparent;
        }
    </style>
</div>