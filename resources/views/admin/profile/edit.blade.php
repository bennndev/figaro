<x-admin-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
        <span>Perfil</span>
        <span class="mx-2 text-white">/</span>
        <a href="{{ route('admin.dashboard') }}" class="text-[#FFFFFF]  flex items-center">
            
            <span>Inicio</span>
        </a>
    </h2>
</x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6 space-y-6">
            {{-- Información del perfil --}}
            <div class="bg-[#2A2A2A] shadow-md text-white rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-4 border-b border-white pb-2">Información del Perfil</h3>
                <div class="max-w-xl">
                    @include('admin.profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Actualizar contraseña --}}
            <div class="bg-[#2A2A2A] shadow-md text-white rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-4 border-b border-white pb-2">Actualizar Contraseña</h3>
                <div class="max-w-xl">
                    @include('admin.profile.partials.update-password-form')
                </div>
            </div>
        </div>

    </div>
</x-admin-app-layout>

