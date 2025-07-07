<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Perfil del Admin</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('admin.dashboard') }}" class="text-white hover:underline">Inicio</a>
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
                            <div class="w-24 h-24 rounded-full bg-gray-600 flex items-center justify-center border-4 border-white shadow-lg">
                                <i class="bi bi-person-fill text-white text-3xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-white">{{ Auth::guard('admin')->user()->name }} {{ Auth::guard('admin')->user()->last_name }}</h1>
                            <p class="text-white/70 text-lg">{{ Auth::guard('admin')->user()->email }}</p>
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
                                <span class="text-white">{{ Auth::guard('admin')->user()->name }}</span>
                            </div>
                        </div>
                        
                        {{-- Apellido --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300">Apellido</label>
                            <div class="bg-[#1E1E1E] p-3 rounded-lg border border-white/10">
                                <span class="text-white">{{ Auth::guard('admin')->user()->last_name ?? 'No especificado' }}</span>
                            </div>
                        </div>
                        
                        {{-- Email --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300">Correo electrónico</label>
                            <div class="bg-[#1E1E1E] p-3 rounded-lg border border-white/10">
                                <span class="text-white">{{ Auth::guard('admin')->user()->email }}</span>
                            </div>
                        </div>
                        
                        {{-- Rol --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300">Rol</label>
                            <div class="bg-[#1E1E1E] p-3 rounded-lg border border-white/10">
                                <span class="text-white">Administrador</span>
                            </div>
                        </div>
                        
                        {{-- Fecha de registro --}}
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-medium text-gray-300">Miembro desde</label>
                            <div class="bg-[#1E1E1E] p-3 rounded-lg border border-white/10">
                                <span class="text-white">{{ Auth::guard('admin')->user()->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {{-- Modal oculto, se activa con evento personalizado --}}
    <x-admin.perfil />
</x-admin-app-layout>

