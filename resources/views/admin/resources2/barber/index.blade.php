<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Barberos</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('admin.dashboard') }}" class="text-[#FFFFFF] flex items-center">
                <span>Inicio</span>
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-white shadow-sm sm:rounded-lg p-6">
                {{-- Formulario de búsqueda --}}
                <form method="GET" action="{{ route('admin.barbers.index') }}"
      class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">

    {{-- Nombre --}}
    <div>
        <label for="name" class="block text-sm font-medium text-white">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="Nombre"
               value="{{ request('name') }}"
               class="mt-1 bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"/>
    </div>

    {{-- Apellido --}}
    <div>
        <label for="last_name" class="block text-sm font-medium text-white">Apellido:</label>
        <input type="text" name="last_name" id="last_name" placeholder="Apellido"
               value="{{ request('last_name') }}"
               class="mt-1 bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"/>
    </div>

    {{-- Especialidad --}}
    <div>
        <label for="specialty_id" class="block text-sm font-medium text-white">Especialidad:</label>
        <select name="specialty_id" id="specialty_id"
                class="mt-1 bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500">
            <option value="">-- Todas --</option>
            @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}" {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>
                    {{ $specialty->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Botones --}}
<div class="flex gap-2 mt-5">
    {{-- Botón Filtrar con ícono --}}
    <button type="submit"
            class="flex items-center justify-center gap-2 px-4 py-2 bg-white text-[#2A2A2A] font-semibold rounded shadow hover:bg-white/80 w-fit">
        <i class="bi bi-funnel-fill"></i>

    </button>

    {{-- Botón Limpiar --}}
    <a href="{{ route('admin.barbers.index') }}"
       class="px-4 py-2 bg-white text-[#2A2A2A] font-semibold rounded shadow hover:bg-white/80 text-center w-fit">
        Limpiar
    </a>
</div>

</form>
<div x-data="{ showModal: false }" class="relative">
    {{-- BOTÓN --}}
    <div class="mb-6 flex justify-end">
        <x-admin.barber-create :specialties="$specialties" />

    </div>

    {{-- MODAL --}}
    

    
                {{-- Mensaje de sesión --}}
                

                {{-- Tabla de barberos --}}
@if ($barbers->isEmpty())
    <p class="text-center text-gray-400 min-h-[200px]">No hay barberos registrados.</p>
@else
    <x-admin.table class="min-w-[1000px]">
        <x-slot name="head">
            <tr>
                <th class="px-4 py-2">Foto</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Apellido</th>
                <th class="px-4 py-2">Especialidades</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Teléfono</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </x-slot>

        @foreach ($barbers as $barber)
            <tr class="border-b border-gray-700 hover:bg-[#FFFFFF]/20 transition">
                <td class="px-4 py-2 text-center">
                    @if ($barber->profile_photo)
                        <img src="{{ asset('storage/' . $barber->profile_photo) }}"
                             alt="Foto de perfil"
                             class="h-10 w-10 object-cover rounded-full mx-auto shadow">
                    @else
                        <span class="text-gray-400 italic">Sin foto</span>
                    @endif
                </td>
                <td class="px-4 py-2">{{ $barber->name }}</td>
                <td class="px-4 py-2">{{ $barber->last_name }}</td>
                <td class="px-4 py-2">
                    @if ($barber->specialties->isNotEmpty())
                        {{ $barber->specialties->pluck('name')->join(', ') }}
                    @else
                        <span class="text-gray-400 italic">Sin especialidades</span>
                    @endif
                </td>
                <td class="px-4 py-2">{{ $barber->email }}</td>
                <td class="px-4 py-2">{{ $barber->phone_number }}</td>
                <td class="px-4 py-2 whitespace-nowrap">
                    <div class="flex items-center gap-2">
                        {{-- Ver --}}
                        <button @click="$dispatch('open-modal-show-barber-{{ $barber->id }}')" title="Ver"
                                class="text-white hover:text-white/70 transition">
                            <i class="bi bi-eye-fill"></i>
                        </button>

                        {{-- Editar --}}
                        <button @click="$dispatch('open-modal-edit-barber-{{ $barber->id }}')" title="Editar"
                                class="text-white hover:text-white/70 transition">
                            <i class="bi bi-pencil-fill"></i>
                        </button>

                        {{-- Eliminar --}}
                        <button onclick="confirmDelete('{{ route('admin.barbers.destroy', $barber->id) }}', '{{ $barber->name }} {{ $barber->last_name }}')" 
                                title="Eliminar"
                                class="text-white hover:text-white/70 transition">
                            <i class="bi bi-trash-fill"></i>
                        </button>

                </td>
            </tr>
        @endforeach
    </x-admin.table>

    {{-- Render modales por barbero --}}
    @foreach ($barbers as $barber)
        <x-admin.modal-show-barber :barber="$barber" />
        <x-admin.modal-edit-barber :barber="$barber" :specialties="$specialties" />
    @endforeach

    {{-- Paginación centrada --}}
    <div class="mt-6 flex justify-center min-h-[60px]">
        {{ $barbers->withQueryString()->links() }}
    </div>
@endif

 

           
    </div class="mt-6">
    <x-admin.barber-show />

</x-admin-app-layout>
