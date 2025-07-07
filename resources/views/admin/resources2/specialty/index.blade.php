<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Especialidades</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('admin.dashboard') }}" class="text-[#FFFFFF] hover:underline flex items-center">
                <span>Inicio</span>
            </a>
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" shadow-sm sm:rounded-lg "><br>

                <div class="px-6 pb-6">
                    {{-- Filtros --}}
                   <form method="GET" action="{{ route('admin.specialties.index') }}" class="mb-6 flex flex-wrap gap-4 items-end">
    {{-- Campo de búsqueda por nombre --}}
    <div>
        <label for="name" class="block mb-1 text-sm text-white">Nombre:</label>
        <input
            type="text"
            name="name"
            id="name"
            value="{{ request('name') }}"
            placeholder="Buscar por nombre"
            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
        >
    </div>

    {{-- Botones --}}
    <div class="flex gap-3 justify-end">
        {{-- Botón Buscar con ícono --}}
        <button type="submit"
            class="bg-white text-[#2A2A2A] font-semibold py-2 px-4 rounded shadow flex items-center gap-2 hover:bg-white/80">
            <i class="bi bi-funnel-fill"></i>
        </button>

        {{-- Botón Limpiar con estilo consistente --}}
        <a href="{{ route('admin.specialties.index') }}"
            class="bg-white text-[#2A2A2A] font-semibold py-2 px-4 rounded shadow flex items-center gap-2 hover:bg-white/80">
           <span>Limpiar</span>
        </a>
    </div>
</form>


                    {{-- Mensaje --}}
                   
                   {{-- Tabla de Especialidades --}}
@if ($specialties->isEmpty())
    <p class="text-white">No hay especialidades registradas.</p>
@else
    <div class="mt-6 overflow-x-visible rounded-lg">
        <x-admin.table class="w-full text-sm">
            <x-slot name="head">
                <tr>
                    <th class="px-4 py-3 text-left whitespace-nowrap">ID</th>
                    <th class="px-4 py-3 text-left whitespace-nowrap">Nombre</th>
                    <th class="px-4 py-3 text-center whitespace-nowrap">Acciones</th>
                </tr>
            </x-slot>

            @foreach ($specialties as $specialty)
                <tr class="border-t border-gray-700 hover:bg-[#FFFFFF]/20 transition">
                    <td class="px-4 py-2">{{ $specialty->id }}</td>
                    <td class="px-4 py-2">{{ $specialty->name }}</td>
                    <td class="px-4 py-2 text-center space-x-3 whitespace-nowrap">
                        {{-- Ver (modal) --}}
                        <button 
                            @click="$dispatch('open-modal-show-specialty-{{ $specialty->id }}')" 
                            class="text-white hover:text-white/70"
                            title="Ver"
                        >
                            <i class="bi bi-eye-fill text-lg"></i>
                        </button>

                        {{-- Editar (modal) --}}
                        <button 
                            @click="$dispatch('open-modal-edit-specialty-{{ $specialty->id }}')" 
                            class="text-white hover:text-white/70"
                            title="Editar"
                        >
                            <i class="bi bi-pencil-square text-lg"></i>
                        </button>

                        {{-- Eliminar --}}
                        <button 
                            onclick="confirmDelete('{{ route('admin.specialties.destroy', $specialty->id) }}', '{{ $specialty->name }}')"
                            class="text-white hover:text-white/70 bg-transparent border-none cursor-pointer"
                            title="Eliminar"
                        >
                            <i class="bi bi-trash-fill text-lg"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-admin.table>
    </div>

    {{-- Renderizar los modales fuera de la tabla --}}
    @foreach ($specialties as $specialty)
        <x-admin.modal-show-specialty :specialty="$specialty" />
        <x-admin.modal-edit-specialty :specialty="$specialty" />
    @endforeach
@endif




                    {{-- Botón --}}
                    <div class="mt-6">

    <!-- Componente del modal -->
    <x-admin.specialty-create />
</div>

                </div>
            </div>
        </div>
    </div>
    <x-admin.alert-delete />
    <x-admin.alert-success />
</x-admin-app-layout>
