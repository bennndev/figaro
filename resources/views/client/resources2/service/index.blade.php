<x-app-layout>
     <x-slot name="header">
    <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
        <span>Servicios</span>
        <span class="mx-2 text-white">/</span>
        <a href="{{ route('dashboard') }}" class="text-[#FFFFFF]  flex items-center">
            
            <span>Inicio</span>
        </a>
    </h2>
</x-slot>
    <div x-data="{ showServiceModal: false, selectedService: null }">

        {{-- 🔹 Filtro con su propio fondo claro --}}
        <div class="py-6 bg-[#1E1E1E]">
            <div class="max-w-7xl mx-auto">
                <form method="GET" action="{{ route('client.services.index') }}"
                    class="bg-[#2A2A2A] text-white p-6 rounded shadow-sm flex flex-wrap items-end gap-4">

                    {{-- Nombre --}}
                    <div class="flex flex-col w-full sm:w-auto">
                        <label for="name" class="block text-sm font-medium">Nombre del servicio</label>
                        <input type="text" name="name" id="name" value="{{ request('name') }}"
                            placeholder="Buscar por nombre"
                            class="mt-1 w-full sm:w-56 border border-gray-500 rounded-md bg-[#1E1E1E] text-white focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base py-1.5 px-2">
                    </div>

                    {{-- Especialidad --}}
                    <div class="flex flex-col w-full sm:w-auto">
                        <label for="specialty_id" class="block text-sm font-medium">Especialidad</label>
                        <select name="specialty_id" id="specialty_id"
                            class="mt-1 w-full sm:w-56 border border-gray-500 rounded-md bg-[#1E1E1E] text-white focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base py-1.5 px-2">
                            <option value="">-- Todas --</option>
                            @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}" {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>
                                    {{ $specialty->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="flex gap-2 ml-auto w-full sm:w-auto mt-2 sm:mt-0">
                        <button type="submit"
                            class="w-full sm:w-auto px-4 py-2 bg-white text-sm sm:text-base rounded hover:bg-gray-200 transition flex items-center justify-center">
                            <i class="bi bi-funnel-fill text-[20px] sm:text-[24px]" style="color: #2A2A2A;"></i>
                        </button>
                        <a href="{{ route('client.services.index') }}"
                            class="w-full sm:w-auto text-center px-4 py-2 bg-white text-[#2A2A2A] text-sm sm:text-base rounded hover:bg-gray-200 transition flex items-center justify-center">
                            Limpiar
                        </a>
                        
                    </div>
                </form>
            </div>
        </div>

        {{-- 🔹 Sección de tarjetas sin fondo propio --}}
        <div class="py-6">
<div class="max-w-7xl mx-auto">
                @if ($services->isEmpty())
                    <p class="text-center text-gray-400 mt-10">No hay servicios disponibles.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($services as $service)
                            <div
                                class="bg-[#2A2A2A] text-white shadow-md border border-[#E5E4E2] rounded-xl p-4 relative transition transform hover:scale-[1.02] hover:shadow-lg hover:border-white">
                                <img src="{{ asset('storage/' . $service->image) }}"
                                    alt="{{ $service->name }}"
                                    class="w-full h-48 object-cover rounded-md mb-4 ">

                                <h3 class="text-xl font-bold">{{ $service->name }}</h3>
                                <p class="text-white/80 mt-2 text-sm">{{ Str::limit($service->description, 100) }}</p>
                                <p class="mt-2"><strong>Duración:</strong> {{ $service->duration_minutes }} min</p>
                                <p class="text-green-300 font-bold">S/. {{ number_format($service->price, 2) }}</p>

                                <button @click="selectedService = {{ $service->toJson() }}; showServiceModal = true"
                                    class="absolute bottom-4 right-4 text-[#FFFFFF] text-3xl hover:text-[#FFFFFF]/60 transition">
                                    <i class="bi bi-plus-circle-fill"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    {{-- Paginación --}}
                    <div class="mt-8 text-white">
                        {{ $services->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>

        {{-- 🔹 Modal Global (igual que antes) --}}
        <x-client.modal-service />
    </div>
    <x-client.perfil :user="Auth::user()" />

</x-app-layout>
