<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Perfil</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('dashboard') }}" class="text-[#FFFFFF] flex items-center">
                <span>Inicio</span>
            </a>
        </h2>
    </x-slot>

    <div x-data @open-profile-modal.window="showPerfil = true">
        {{-- Sección principal --}}
        <div class="bg-[#2A2A2A] text-white rounded-lg shadow-md p-6 flex flex-col md:flex-row items-center justify-between gap-6">
    <div class="flex items-center gap-5">
        <img src="{{ Auth::user()->profile_photo_url }}" alt="Foto de perfil"
            class="w-24 h-24 rounded-full object-cover border border-gray-600 shadow-lg">
        <div>
            <h3 class="text-2xl font-extrabold">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h3>
            <p class="text-lg text-white/80">{{ Auth::user()->email }}</p>
        </div>
    </div>
    <div>
        <button 
            @click="$dispatch('open-profile-modal')"
            class="bg-white text-[#1E1E1E] px-4 py-2 rounded shadow font-semibold hover:bg-gray-200 transition">
            Editar Perfil
        </button>
    </div>
</div>
<br>

            {{-- Información detallada --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-[#2A2A2A] p-4 rounded-lg">
                    <p class="text-sm text-white/70">Nombre</p>
                    <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
                </div>
                <div class="bg-[#2A2A2A] p-4 rounded-lg">
                    <p class="text-sm text-white/70">Apellido</p>
                    <p class="text-lg font-semibold">{{ Auth::user()->last_name }}</p>
                </div>
                <div class="bg-[#2A2A2A] p-4 rounded-lg">
                    <p class="text-sm text-white/70">Correo</p>
                    <p class="text-lg font-semibold">{{ Auth::user()->email }}</p>
                </div>
                <div class="bg-[#2A2A2A] p-4 rounded-lg">
                    <p class="text-sm text-white/70">Teléfono</p>
                    <p class="text-lg font-semibold">
                        {{ Auth::user()->phone_number ?? 'No registrado' }}
                    </p>
                </div>
                <div class="bg-[#2A2A2A] p-4 rounded-lg col-span-full">
                    <p class="text-sm text-white/70">Fecha de registro</p>
                    <p class="text-lg font-semibold">
                        {{ Auth::user()->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Modal oculto, se activa con evento personalizado --}}
        <x-client.perfil :user="Auth::user()" />
    </div>
</x-app-layout>
