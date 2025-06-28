<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Barbero') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
            {{-- Información principal --}}
            <div class="flex flex-col items-center">
                <img src="{{ asset('storage/' . $barber->profile_photo) }}"
                     alt="Foto de perfil"
                     class="w-40 h-40 object-cover rounded-full border shadow-md mb-4">
                <h3 class="text-2xl font-bold mb-2">{{ $barber->name }} {{ $barber->last_name }}</h3>
            </div>

            {{-- Descripción --}}
            <p class="text-gray-700 mt-4">{{ $barber->description }}</p>

            {{-- Especialidades --}}
            <div class="mt-6 border-t pt-4">
                <h4 class="text-lg font-semibold mb-2">Especialidades</h4>
                <div class="flex flex-wrap gap-2">
                    @forelse($barber->specialties as $specialty)
                        <span class="bg-indigo-100 text-indigo-800 text-sm px-3 py-1 rounded-full">
                            {{ $specialty->name }}
                        </span>
                    @empty
                        <p class="text-gray-500 text-sm">Este barbero no tiene especialidades registradas.</p>
                    @endforelse
                </div>
            </div>

            {{-- Contacto --}}
            <div class="mt-6 border-t pt-4">
                <h4 class="text-lg font-semibold mb-2">Contacto</h4>
                <p><strong>Email:</strong> {{ $barber->email }}</p>
                <p><strong>Teléfono:</strong> {{ $barber->phone_number }}</p>
            </div>

            {{-- Volver --}}
            <div class="mt-6">
                <a href="{{ route('client.barbers.index') }}" class="text-blue-600 hover:underline">
                    ← Volver al listado
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
