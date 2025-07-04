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
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showViewModal = false"
            class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6 text-black"
        >
            <h3 class="text-lg font-bold mb-4">Barbero {{ $barber->name }} {{ $barber->last_name }}</h3>

            <ul class="list-disc pl-5 space-y-2">
                <li><strong>Email:</strong> {{ $barber->email }}</li>
                <li><strong>Teléfono:</strong> {{ $barber->phone_number }}</li>
                <li><strong>Descripción:</strong> {{ $barber->description ?: 'Sin descripción' }}</li>
                <li><strong>Especialidades:</strong>
                    @if ($barber->specialties->isNotEmpty())
                        <ul class="list-inside list-disc ml-4 mt-1">
                            @foreach ($barber->specialties as $specialty)
                                <li>{{ $specialty->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-gray-500">Sin especialidades registradas</span>
                    @endif
                </li>
                <li><strong>Creado:</strong> {{ $barber->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Actualizado:</strong> {{ $barber->updated_at->format('d/m/Y H:i') }}</li>
            </ul>

            @if ($barber->profile_photo)
                <div class="mt-6">
                    <img src="{{ asset('storage/' . $barber->profile_photo) }}" alt="Foto de perfil"
                         class="h-36 w-36 object-cover rounded-lg shadow">
                </div>
            @endif

            <div class="mt-6 flex justify-end">
                <button @click="showViewModal = false" class="text-gray-600 hover:text-gray-900">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
