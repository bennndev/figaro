<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Perfil del Barbero</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('barber.dashboard') }}" class="text-white hover:underline">Inicio</a>
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- Información del perfil --}}
            <div class="p-6 bg-[#2A2A2A] shadow-md rounded-xl text-white border border-white/10">
                <h3 class="text-xl font-semibold mb-4 pb-2 border-b border-white/20">
                    Información del Perfil
                </h3>
                <div class="max-w-2xl">
                    @include('barber.profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Actualizar contraseña --}}
            <div class="p-6 bg-[#2A2A2A] shadow-md rounded-xl text-white border border-white/10">
                <h3 class="text-xl font-semibold mb-4 pb-2 border-b border-white/20">
                    Actualizar Contraseña
                </h3>
                <div class="max-w-2xl">
                    @include('barber.profile.partials.update-password-form')
                </div>
            </div>

        </div>
    </div>
</x-barber-app-layout>
