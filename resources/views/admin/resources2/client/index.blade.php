<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Clientes</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('admin.dashboard') }}" class="text-[#FFFFFF] flex items-center">
                <span>Inicio</span>
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class=" rounded-xl overflow-hidden">
                <div class="p-6 text-white min-h-[500px] flex flex-col justify-between">
                    {{-- Filtros --}}
                    <form method="GET" action="{{ route('admin.clients.index') }}" class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
    {{-- Nombre --}}
    <div>
        <label for="name" class="block mb-1 text-sm text-white">Nombre:</label>
        <input type="text" name="name" id="name" value="{{ request('name') }}"
            placeholder="Buscar por nombre"
            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
    </div>

    {{-- Apellido --}}
    <div>
        <label for="last_name" class="block mb-1 text-sm text-white">Apellido:</label>
        <input type="text" name="last_name" id="last_name" value="{{ request('last_name') }}"
            placeholder="Buscar por apellido"
            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
    </div>

    {{-- Botones --}}
    <div class="flex gap-2">
        <button type="submit"
            class="bg-white text-[#2A2A2A] font-semibold rounded-md px-4 py-2 hover:bg-white/80 transition flex items-center gap-2">
            <i class="bi bi-funnel-fill"></i>
           
        </button>

        <a href="{{ route('admin.clients.index') }}"
            class="bg-white text-[#2A2A2A] font-semibold rounded-md px-4 py-2 hover:bg-white/80 transition flex items-center gap-2">
            
            <span>Limpiar</span>
        </a>
    </div>
</form>


                    {{-- Botón Crear --}}
                    <div class="mb-6 flex justify-end">
                        <x-admin.client-create />

                    </div>

                    {{-- Mensaje éxito --}}
                    @if (session('message'))
                                       <x-admin.alert-success />

                    @endif

                    {{-- Tabla --}}
@if ($clients->isEmpty())
    <p class="text-center text-gray-400 min-h-[200px]">No hay clientes registrados.</p>
@else
    <x-admin.table class="min-w-[1000px]">
        <x-slot name="head">
            <tr>
                <th class="px-4 py-3">Foto</th>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Apellido</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Teléfono</th>
                <th class="px-4 py-3">Acciones</th>
            </tr>
        </x-slot>

        @foreach ($clients as $client)
            <tr class="hover:bg-[#FFFFFF]/20">
                <td class="px-4 py-2 text-center">
                    <img src="{{ $client->profile_photo_url }}"
                         alt="Foto de perfil"
                         class="h-10 w-10 object-cover rounded-full mx-auto shadow">
                </td>
                <td class="px-4 py-2">{{ $client->name }}</td>
                <td class="px-4 py-2">{{ $client->last_name }}</td>
                <td class="px-4 py-2">{{ $client->email }}</td>
                <td class="px-4 py-2">{{ $client->phone_number }}</td>
                <td class="px-4 py-2 whitespace-nowrap">
                    <div class="flex items-center space-x-3">
                        {{-- Ver --}}
                        <button @click="$dispatch('open-modal-show-{{ $client->id }}')" title="Ver"
                            class="text-white hover:text-white/70 transition">
                            <i class="bi bi-eye-fill"></i>
                        </button>

                        {{-- Editar --}}
                        <button @click="$dispatch('open-modal-edit-{{ $client->id }}')" title="Editar"
                            class="text-white hover:text-white/70 transition">
                            <i class="bi bi-pencil-fill"></i>
                        </button>

                        {{-- Eliminar --}}
                        <button onclick="confirmDelete('{{ route('admin.clients.destroy', $client->id) }}', '{{ $client->name }} {{ $client->last_name }}')"
                                title="Eliminar"
                                class="text-white hover:text-white/70 transition">
                            <i class="bi bi-trash-fill"></i>
                        </button>

                    </div>
                </td>
            </tr>
        @endforeach
    </x-admin.table>

    {{-- Render de los Modales FUERA de la tabla --}}
    @foreach ($clients as $client)
        <x-admin.modal-show-client :client="$client" />
        <x-admin.modal-edit-client :client="$client" />
    @endforeach
@endif


                    {{-- Paginación --}}
                    <div class="mt-6 text-white flex justify-center">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-admin.alert-delete />
    <x-admin.alert-success />

</x-admin-app-layout>
