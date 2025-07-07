<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Perfil del Barbero</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('barber.dashboard') }}" class="text-white hover:underline">Inicio</a>
        </h2>
    </x-slot>

    <div class="py-6 min-h-screen">
        <div class="max-w-7xl mx-auto">
            
            {{-- Información del perfil --}}
            <div class="bg-[#2A2A2A] shadow-md rounded-xl text-white border border-white/10 overflow-hidden">
                
                {{-- Header del perfil --}}
                <div class="bg- px-6 py-8">
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            <img src="{{ Auth::guard('barber')->user()->profile_photo_url ?? asset('images/default-profile.png') }}" 
                                 alt="Foto de perfil" 
                                 class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                        </div>
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-white">{{ Auth::guard('barber')->user()->name }}</h1>
                            <p class="text-blue-100 text-lg">{{ Auth::guard('barber')->user()->email }}</p>
                            <button @click="$dispatch('open-profile-modal')" 
                                    class="mt-4 bg-white text-[#2A2A2A] px-6 py-2 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                                <i class="bi bi-pencil mr-2"></i>Editar Perfil
                            </button>
                        </div>
                    </div>
                </div>
                
                {{-- Información detallada --}}
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Nombre --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300">Nombre</label>
                            <div class="bg-[#1E1E1E] p-3 rounded-lg border border-white/10">
                                <span class="text-white">{{ Auth::guard('barber')->user()->name }}</span>
                            </div>
                        </div>
                        
                        {{-- Apellido --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300">Apellido</label>
                            <div class="bg-[#1E1E1E] p-3 rounded-lg border border-white/10">
                                <span class="text-white">{{ Auth::guard('barber')->user()->last_name ?? 'No especificado' }}</span>
                            </div>
                        </div>
                        
                        {{-- Email --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300">Correo electrónico</label>
                            <div class="bg-[#1E1E1E] p-3 rounded-lg border border-white/10">
                                <span class="text-white">{{ Auth::guard('barber')->user()->email }}</span>
                            </div>
                        </div>
                        
                        {{-- Teléfono --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300">Teléfono</label>
                            <div class="bg-[#1E1E1E] p-3 rounded-lg border border-white/10">
                                <span class="text-white">{{ Auth::guard('barber')->user()->phone_number ?? 'No especificado' }}</span>
                            </div>
                        </div>
                        
                        {{-- Especialidades --}}
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-medium text-gray-300">Especialidades</label>
                            <div class="bg-[#1E1E1E] p-3 rounded-lg border border-white/10">
                                @if(Auth::guard('barber')->user()->specialties && Auth::guard('barber')->user()->specialties->count() > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(Auth::guard('barber')->user()->specialties as $specialty)
                                            <span class="bg-[#FFFFFF] text-[#2A2A2A] px-3 py-1 rounded-full text-sm">
                                                {{ $specialty->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-white">No especificado</span>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Fecha de registro --}}
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-medium text-gray-300">Miembro desde</label>
                            <div class="bg-[#1E1E1E] p-3 rounded-lg border border-white/10">
                                <span class="text-white">{{ Auth::guard('barber')->user()->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-barber-app-layout>
