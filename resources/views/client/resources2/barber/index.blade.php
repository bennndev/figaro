<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
        <span>Barberos</span>
        <span class="mx-2 text-white">/</span>
        <a href="{{ route('dashboard') }}" class="text-[#FFFFFF]  flex items-center">
            
            <span>Inicio</span>
        </a>
    </h2>
</x-slot>

    <div x-data="{ showModal: false, selectedBarber: null }">

        {{-- Formulario de Filtros --}}
<div class="py-6">
    <div class="max-w-7xl mx-auto">
        <form method="GET" action="{{ route('client.barbers.index') }}"
              class="mb-6 bg-[#2A2A2A] text-white p-6 rounded shadow-sm flex flex-wrap gap-4 items-end">

            {{-- Nombre --}}
            <div class="flex flex-col w-full sm:w-auto">
                <label for="name" class="block text-sm font-medium">Nombre</label>
                <input type="text" name="name" id="name" value="{{ $filters['name'] ?? '' }}"
                       class="mt-1 w-full sm:w-48 border border-gray-500 rounded-md bg-[#1E1E1E] text-white focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base py-1.5 px-2">
            </div>

            {{-- Apellido --}}
            <div class="flex flex-col w-full sm:w-auto">
                <label for="last_name" class="block text-sm font-medium">Apellido</label>
                <input type="text" name="last_name" id="last_name" value="{{ $filters['last_name'] ?? '' }}"
                       class="mt-1 w-full sm:w-48 border border-gray-500 rounded-md bg-[#1E1E1E] text-white focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base py-1.5 px-2">
            </div>

            {{-- Especialidad --}}
            <div class="flex flex-col w-full sm:w-auto">
                <label for="specialty_id" class="block text-sm font-medium">Especialidad</label>
                <select name="specialty_id" id="specialty_id"
                        class="mt-1 w-full sm:w-48 border border-gray-500 rounded-md bg-[#1E1E1E] text-white focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base py-1.5 px-2">
                    <option value="">-- Todas --</option>
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty->id }}"
                                {{ ($filters['specialty_id'] ?? '') == $specialty->id ? 'selected' : '' }}>
                            {{ $specialty->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Botones --}}
            <div class="flex gap-2 ml-auto w-full sm:w-auto mt-2 sm:mt-0">
                <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 sm:py-2 bg-white text-sm sm:text-base rounded hover:bg-gray-200 transition flex items-center justify-center">
                    <i class="bi bi-funnel-fill text-[20px] sm:text-[24px]" style="color: #2A2A2A;"></i>
                </button>
                <a href="{{ route('client.barbers.index') }}"
                   class="w-full sm:w-auto text-center px-4 py-2 sm:py-2 bg-white text-[#2A2A2A] text-sm sm:text-base rounded hover:bg-gray-200 transition flex items-center justify-center">
                    Limpiar
                </a>
                
            </div>
        </form>
    </div>
</div>



        {{-- Tarjetas de barberos --}}
        <div class="flex flex-wrap justify-start gap-6 mt-8">
            @forelse ($barbers as $barber)
                <div class="flex bg-[#2A2A2A] text-white shadow-md rounded-xl p-4 border border-[#E5E4E2] transition transform hover:scale-[1.02] hover:shadow-lg hover:border-white"
                     style="width: auto; min-width: 300px; max-width: 100%;">

                    {{-- Imagen --}}
                    <div class="flex-shrink-0 mr-4">
                        @if ($barber->profile_photo)
                            <img src="{{ $barber->profile_photo_url }}"
                                alt="Foto de perfil"
                                class="w-24 h-24 object-cover rounded-full border shadow-md">
                        @else
                            <img src="{{ asset('images/default-barber.png') }}"
                                alt="Foto por defecto"
                                class="w-24 h-24 object-cover rounded-full border shadow-md">
                        @endif
                    </div>

                    {{-- Contenido --}}
                    <div class="flex flex-col justify-center flex-grow">
                        <h3 class="text-lg font-bold">{{ $barber->name }} {{ $barber->last_name }}</h3>

                        {{-- Especialidades --}}
                        <div class="mt-2">
                            <p class="text-sm font-semibold mb-1">Especialidades:</p>
                            <div class="flex flex-wrap gap-2">
                                @forelse($barber->specialties as $specialty)
                                    <span class="bg-white text-black text-xs px-3 py-1 rounded-full">
                                        {{ $specialty->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-gray-300">Sin especialidades</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Botón Ver Más --}}
                        <div class="mt-3 flex justify-end">
                            <button @click="selectedBarber = {{ $barber->toJson() }}; showModal = true"
                                    class="text-white hover:text-indigo-300 transition text-3xl">
                                <i class="bi bi-plus-circle-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-center w-full">No hay barberos disponibles en este momento.</p>
            @endforelse
        </div>
<x-client.modal-barber />





        {{-- Paginación --}}
        <div class="max-w-7xl mx-auto mt-8">
            {{ $barbers->appends($filters)->links() }}
        </div>
    </div>
</x-app-layout>
