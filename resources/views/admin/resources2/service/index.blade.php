<x-admin-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
        <span>Servicios</span>
        <span class="mx-2 text-white">/</span>
        <a href="{{ route('admin.dashboard') }}" class="text-[#FFFFFF]  flex items-center">
            
            <span>Inicio</span>
        </a>
    </h2>
</x-slot>
    <div class="py-12 bg-[#1F1F1F] min-h-screen text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  sm:rounded-xl">
                

                <div class="p-6">
                    {{-- Formulario de filtros --}}
                    <form method="GET" action="{{ route('admin.services.index') }}" class="mb-6 flex flex-wrap gap-4 items-end">
    {{-- Nombre --}}
    <div>
        <label for="name" class="block mb-1 text-sm">Nombre:</label>
        <input type="text" name="name" id="name"
            value="{{ request('name') }}"
            placeholder="Buscar por nombre"
            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 focus:outline-none focus:border-blue-500" />
    </div>

    {{-- Especialidad --}}
    <div>
        <label for="specialty_id" class="block mb-1 text-sm">Especialidad:</label>
        <select name="specialty_id" id="specialty_id"
            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
            <option value="">-- Todas --</option>
            @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}" {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>
                    {{ $specialty->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Botones --}}
    <div class="flex gap-3">
        {{-- Botón Buscar con ícono --}}
        <button type="submit"
            class="bg-white text-[#2A2A2A] font-semibold py-2 px-4 rounded shadow flex items-center gap-2 hover:bg-white/80">
            <i class="bi bi-funnel-fill"></i>
        </button>

        {{-- Botón Limpiar --}}
        <a href="{{ route('admin.services.index') }}"
            class="bg-white text-[#2A2A2A] font-semibold py-2 px-4 rounded shadow hover:bg-white/80">
            Limpiar
        </a>
    </div>
</form>


                    {{-- Mensaje de éxito --}}
                    {{-- Tabla de resultados --}}
@if ($services->isEmpty())
    <p class="text-gray-300">No hay servicios registrados.</p>
@else
    <div class="mt-6 overflow-x-visible rounded-lg">
        <x-admin.table class="w-full text-sm">
            <x-slot name="head">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Duración (min)</th>
                    <th class="px-4 py-3">Precio</th>
                    <th class="px-4 py-3">Especialidades</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </x-slot>

            @foreach ($services as $service)
                <tr class="hover:bg-[#FFFFFF]/20">
                    <td class="px-4 py-3">{{ $service->id }}</td>
                    <td class="px-4 py-3">{{ $service->name }}</td>
                    <td class="px-4 py-3">{{ $service->duration_minutes }}</td>
                    <td class="px-4 py-3">${{ number_format($service->price, 2) }}</td>
                    <td class="px-4 py-3">
                        @if ($service->specialties && $service->specialties->isNotEmpty())
                            <ul class="list-disc list-inside">
                                @foreach ($service->specialties as $specialty)
                                    <li>{{ $specialty->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <em>Sin especialidades</em>
                        @endif
                    </td>
                    <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                        {{-- Ver (Modal) --}}
                        <button @click="$dispatch('open-modal-show-service-{{ $service->id }}')"
                                title="Ver" class="text-[#FFFFFF] hover:text-[#FFFFFF]/70">
                            <i class="bi bi-eye-fill"></i>
                        </button>

                        {{-- Editar (Modal) --}}
                        <button @click="$dispatch('open-modal-edit-service-{{ $service->id }}')"
                                title="Editar" class="text-[#FFFFFF] hover:text-[#FFFFFF]/70">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        {{-- Eliminar --}}
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                              class="inline"
                              onsubmit="return confirm('¿Estás seguro que deseas eliminar este servicio?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Eliminar"
                                    class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 bg-transparent border-none p-0">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </x-admin.table>
    </div>

    {{-- Renderizado de los modales fuera de la tabla --}}
    @foreach ($services as $service)
        <x-admin.modal-show-service :service="$service" />
        <x-admin.modal-edit-service :service="$service" :specialties="$specialties" />
    @endforeach
@endif



                    {{-- Paginación --}}
                    <div class="mt-6 text-white">
                        {{ $services->appends(request()->query())->links() }}
                    </div>

                    {{-- Crear nuevo --}}
                    <div x-data="{ showServiceModal: false }" class="mt-6">
    <button 
        @click="showServiceModal = true"
        class="px-5 py-2 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition"
    >
        + Crear nuevo servicio
    </button>

    <x-admin.service-create :specialties="$specialties" />

</div>

                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
