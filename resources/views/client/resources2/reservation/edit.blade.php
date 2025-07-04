<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Servicios') }}
        </h2>
    </x-slot>

    <div x-data="{ showServiceModal: false, selectedService: null }">

        {{-- 🔷 Filtro con su propio fondo oscuro --}}
        <div class="py-6 bg-[#2A2A2A]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form method="GET" action="{{ route('client.services.index') }}"
                    class="bg-[#1E1E1E] text-white p-6 rounded shadow-sm flex flex-wrap items-end gap-4">

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
                        <a href="{{ route('client.services.index') }}"
                            class="w-full sm:w-auto text-center px-4 py-2 bg-white text-[#2A2A2A] text-sm sm:text-base rounded hover:bg-gray-200 transition flex items-center justify-center">
                            Limpiar
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto px-4 py-2 bg-white text-sm sm:text-base rounded hover:bg-gray-200 transition flex items-center justify-center">
                            <i class="bi bi-funnel-fill text-[20px] sm:text-[24px]" style="color: #2A2A2A;"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- 🔷 Sección de tarjetas, también con fondo oscuro separado --}}
        <div class="py-10 bg-[#2A2A2A] min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if ($services->isEmpty())
                    <p class="text-center text-gray-400 mt-10">No hay servicios disponibles.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($services as $service)
                            <div
                                class="bg-[#2A2A2A] text-white shadow-md border border-[#E5E4E2] rounded-xl p-4 relative transition transform hover:scale-[1.02] hover:shadow-lg hover:border-white">
                                <img src="{{ asset('storage/' . $service->image) }}"
                                    alt="{{ $service->name }}"
                                    class="w-full h-48 object-cover rounded-md mb-4 border border-white">

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

                    <div class="mt-8 text-white">
                        {{ $services->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>

        {{-- Modal (sin cambios) --}}
        <div x-show="showServiceModal" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-md"
            style="display: none;">
            <template x-if="selectedService">
                <div @click.away="showServiceModal = false"
                    class="w-full max-w-4xl mx-4 rounded-xl shadow-2xl bg-[#2A2A2A] text-white p-6 md:p-8 overflow-hidden max-h-[90vh] relative">
                    <div class="flex justify-between items-center pb-3 mb-6">
                        <h2 class="text-2xl md:text-3xl font-bold">Detalle del Servicio</h2>
                        <button @click="showServiceModal = false"
                            class="text-white hover:text-gray-300 text-3xl font-bold">&times;</button>
                    </div>

                    <div class="overflow-y-auto max-h-[calc(90vh-100px)] pr-1 md:pr-2">
                        <div class="flex flex-col md:flex-row gap-6 md:gap-8 pb-24">
                            <div class="w-full md:w-1/2">
                                <img :src="'/storage/' + selectedService.image" alt="Imagen del servicio"
                                    class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg">
                            </div>
                            <div class="w-full md:w-1/2">
                                <h3 class="text-2xl md:text-3xl font-bold mb-4" x-text="selectedService.name"></h3>
                                <div class="bg-white/10 rounded-lg p-4 mb-6">
                                    <div class="flex justify-between items-center gap-4 flex-wrap">
                                        <div>
                                            <span class="block text-sm text-white/80">Duración</span>
                                            <span class="text-lg md:text-xl font-semibold"
                                                x-text="selectedService.duration_minutes + ' min'"></span>
                                        </div>
                                        <div class="text-right">
                                            <span class="block text-sm text-white/80">Precio</span>
                                            <span class="text-xl md:text-2xl font-bold text-green-400"
                                                x-text="'S/. ' + Number(selectedService.price).toFixed(2)"></span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-lg md:text-xl font-semibold mb-2">Descripción</h4>
                                    <p class="text-white/90 text-base md:text-lg leading-relaxed"
                                        x-text="selectedService.description"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-5 right-0 left-0 px-6 flex justify-center md:justify-end">
                        <a :href="'/client/reservations/create'"
                            class="bg-white text-[#2A2A2A] hover:bg-gray-100 font-bold py-3 px-6 rounded-lg text-lg shadow-lg transition w-full md:w-auto text-center">
                            Reservar este servicio
                        </a>
                    </div>
                </div>
            </template>
        </div>

    </div>
</x-app-layout>
