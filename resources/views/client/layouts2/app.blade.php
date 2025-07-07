
@props(['title' => 'Panel de Cliente', 'header' => null])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title }}</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    {{-- Tailwind y Alpine.js --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
        [x-cloak] {
            display: none !important;
        }
        
        /* Estilos de scrollbar personalizados */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            transition: background 0.3s ease;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }
        
        /* Para Firefox */
        * {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
        }
        
        *:hover {
            scrollbar-color: rgba(255, 255, 255, 0.4) transparent;
        }
    </style>
</head>
<body class="bg-[#1E1E1E] text-white min-h-screen" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <aside 
            class="fixed inset-y-0 left-0 z-50 w-64 bg-[#2A2A2A] p-4 transform transition-transform duration-300 ease-in-out
                   md:relative md:translate-x-0 md:z-0"
            :class="{ '-translate-x-full': !sidebarOpen }"
            x-transition
        >
            <x-client.sidebar />
        </aside>

        {{-- Overlay para móviles --}}
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition.opacity
        ></div>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="flex-1 flex flex-col w-full overflow-y-auto">

            {{-- Header móvil --}}
            <header class="bg-[#1E1E1E] sticky top-0 z-30 shadow-md p-4 flex items-center justify-between md:hidden">
                <button @click="sidebarOpen = true" class="text-white">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <h1 class="ml-4 text-xl font-bold">{{ $title }}</h1>
            </header>

            {{-- Header escritorio --}}
            @isset($header)
                <header class="bg-[#1E1E1E] sticky top-0 z-30 p-6 shadow hidden md:flex items-center justify-between">
                    <div class="flex items-center">
                        <h2 class="text-2xl font-semibold text-white">{{ $header }}</h2>
                    </div>

                    {{-- Avatar y dropdown --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                            <span class="text-sm text-white/70 group-hover:text-white transition">{{ Auth::user()->name }}</span>
                            <img src="{{ Auth::user()->profile_photo_url }}"
                                alt="Foto de perfil"
                                class="w-10 h-10 rounded-full object-cover border border-gray-500 transition-transform duration-200 transform group-hover:scale-105 group-hover:border-gray-400 shadow-sm" />
                        </button>

                        {{-- Dropdown --}}
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-[#2A2A2A] border border-gray-700 rounded-lg shadow-lg z-50">
                            
                            {{-- Botón para abrir el modal --}}
                            <button 
                                @click="window.dispatchEvent(new CustomEvent('open-profile-modal')); open = false"
                                class="block w-full text-left px-4 py-2 text-sm text-white hover:bg-[#3A3A3A]">
                                Ver perfil
                            </button>
                            <button 
                                @click="window.dispatchEvent(new CustomEvent('open-profile-modal')); open = false"
                                class="block w-full text-left px-4 py-2 text-sm text-white hover:bg-[#3A3A3A]">
                                Editar perfil
                            </button>

                            {{-- Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-white hover:bg-[#3A3A3A]">
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </header>
            @endisset

            {{-- Contenido --}}
            <main class="p-6">
                {{ $slot }}
            </main>

            {{-- Modal del asistente virtual --}}
            <x-client.robot-modal :history="[]" />
        </div>
    </div>

    {{-- Scripts adicionales --}}
    @stack('scripts')
    
    {{-- SweetAlert2 Configuration --}}
    <script>
        // Configuración global de SweetAlert2 para el tema oscuro
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#2A2A2A',
            color: '#ffffff',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Función global para mostrar alertas de éxito
        window.showSuccessAlert = function(title, text = '') {
            Swal.fire({
                icon: 'success',
                title: title,
                text: text,
                background: '#2A2A2A',
                color: '#ffffff',
                confirmButtonColor: '#10B981',
                confirmButtonText: 'Entendido'
            });
        };

        // Función global para mostrar alertas de error
        window.showErrorAlert = function(title, text = '') {
            Swal.fire({
                icon: 'error',
                title: title,
                text: text,
                background: '#2A2A2A',
                color: '#ffffff',
                confirmButtonColor: '#EF4444',
                confirmButtonText: 'Entendido'
            });
        };

        // Función global para mostrar toast de éxito
        window.showSuccessToast = function(title) {
            Toast.fire({
                icon: 'success',
                title: title
            });
        };

        // Función global para mostrar toast de error
        window.showErrorToast = function(title) {
            Toast.fire({
                icon: 'error',
                title: title
            });
        };

        // Función global para mostrar confirmación
        window.showConfirmAlert = function(title, text, confirmText = 'Sí, confirmar', cancelText = 'Cancelar') {
            return Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                background: '#2A2A2A',
                color: '#ffffff',
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: confirmText,
                cancelButtonText: cancelText
            });
        };

        // Detectar mensajes de sesión de Laravel y mostrarlos con SweetAlert2
        @if(session('success'))
            showSuccessToast('{{ session('success') }}');
        @endif

        @if(session('error'))
            showErrorToast('{{ session('error') }}');
        @endif

        @if(session('message'))
            showSuccessToast('{{ session('message') }}');
        @endif
    </script>
</body>

</html>
    