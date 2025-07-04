@props(['service', 'specialties'])

<div 
    x-data="{ showEditServiceModal: false }"
    x-on:open-modal-edit-service-{{ $service->id }}.window="showEditServiceModal = true"
    class="z-50"
>
    <div 
        x-show="showEditServiceModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div 
            @click.outside="showEditServiceModal = false"
            class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 text-black overflow-y-auto max-h-[90vh]"
        >
            <h2 class="text-xl font-semibold mb-4">Editar Servicio</h2>

            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $service->name) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Descripción</label>
                    <textarea name="description" rows="3"
                        class="w-full mt-1 p-2 border border-gray-300 rounded">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Duración (minutos)</label>
                    <input type="number" name="duration_minutes" min="1"
                        value="{{ old('duration_minutes', $service->duration_minutes) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Precio</label>
                    <input type="number" step="0.01" min="0" name="price"
                        value="{{ old('price', $service->price) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Imagen</label>
                    @if($service->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="Imagen actual"
                                 class="w-40 rounded">
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="mt-1">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Especialidades</label>
                    @foreach ($specialties as $specialty)
                        <div>
                            <label>
                                <input type="checkbox" name="specialties[]"
                                       value="{{ $specialty->id }}"
                                       {{ in_array($specialty->id, old('specialties', $service->specialties->pluck('id')->toArray())) ? 'checked' : '' }}>
                                {{ $specialty->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md">
                        Actualizar
                    </button>
                    <button type="button" @click="showEditServiceModal = false"
                        class="text-gray-600 hover:text-gray-900">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
