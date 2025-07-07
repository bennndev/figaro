@props(['barber'])

<div 
    x-data="{ showViewModal: false }"
    x-on:open-modal-show-barber-{{ $barber->id }}.window="showViewModal = true"
    class="z-50"
>
    <!-- Modal -->
    <div 
        x-show="showViewModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
    >
        <div 
            @click.outside="showViewModal = false"
            class="bg-[#1E1E1E] text-white rounded-xl shadow-2xl w-full max-w-3xl p-6 max-h-[90vh] overflow-y-auto scroll-smooth scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800"
        >
            <h3 class="text-2xl font-bold mb-6">Barbero: {{ $barber->name }} {{ $barber->last_name }}</h3>

            <ul class="space-y-3 text-sm leading-relaxed">
                <li><span class="font-semibold text-gray-300">Email:</span> {{ $barber->email }}</li>
                <li><span class="font-semibold text-gray-300">Teléfono:</span> {{ $barber->phone_number }}</li>
                <li>
                    <span class="font-semibold text-gray-300">Descripción:</span> 
                    <span>{{ $barber->description ?: 'Sin descripción' }}</span>
                </li>
                <li>
                    <span class="font-semibold text-gray-300">Especialidades:</span>
                    @if ($barber->specialties->isNotEmpty())
                        <ul class="list-disc list-inside ml-4 mt-1 text-sm text-white/90">
                            @foreach ($barber->specialties as $specialty)
                                <li>{{ $specialty->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-gray-500">Sin especialidades registradas</span>
                    @endif
                </li>
                <li><span class="font-semibold text-gray-300">Creado:</span> {{ $barber->created_at->format('d/m/Y H:i') }}</li>
                <li><span class="font-semibold text-gray-300">Actualizado:</span> {{ $barber->updated_at->format('d/m/Y H:i') }}</li>
            </ul>

            @if ($barber->profile_photo)
                <div class="mt-6">
                    <img src="{{ $barber->profile_photo_url }}" alt="Foto de perfil"
                         class="h-36 w-36 object-cover rounded-lg border border-gray-500 shadow">
                </div>
            @endif

            <div class="mt-6 flex justify-end">
                <button 
                    @click="showViewModal = false" 
                    class="px-4 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition"
                >
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
