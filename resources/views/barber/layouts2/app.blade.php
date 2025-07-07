@props(['title' => 'Panel del Barbero', 'header' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FullCalendar --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.js"></script>

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

    {{-- Tailwind y Alpine.js --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
        [x-cloak] {
            display: none !important;
        }
        
        input[type="date"],
        input[type="time"],
        select {
            background-color: #1F1F1F;
            color: white;
            border: 1px solid #555;
        }

        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
            opacity: 0.8;
        }

        input[type="date"]:hover::-webkit-calendar-picker-indicator,
        input[type="time"]:hover::-webkit-calendar-picker-indicator {
            opacity: 1;
        }

        /* Placeholder blanco para campos vacíos */
        input::placeholder {
            color: #ccc;
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

<body class="bg-[#1E1E1E] text-white min-h-screen" x-data="{ sidebarOpen: false }" :class="{ 'overflow-hidden': sidebarOpen }">
    <div class="flex h-screen overflow-hidden relative">

        {{-- SIDEBAR --}}
        <aside 
            class="fixed inset-y-0 left-0 z-40 w-64 bg-[#2A2A2A] p-4 transform transition-transform duration-300 ease-in-out
                   md:relative md:translate-x-0 md:z-0"
            :class="{ '-translate-x-full': !sidebarOpen }"
            x-transition
        >
            <x-barber.sidebar />
        </aside>

        {{-- OVERLAY MÓVIL --}}
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition.opacity
        ></div>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="flex-1 flex flex-col w-full overflow-y-auto z-0 relative">

            {{-- HEADER MÓVIL --}}
            <header class="bg-[#1E1E1E] sticky top-0 z-20 shadow-md p-4 flex items-center justify-between md:hidden">
                <button @click="sidebarOpen = true" class="text-white">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <h1 class="ml-4 text-xl font-bold ml-auto">Panel del Barbero</h1>
            </header>

            {{-- HEADER ESCRITORIO --}}
            @isset($header)
                <header class="bg-[#1E1E1E] sticky top-0 z-20 p-6 shadow hidden md:flex items-center justify-between">
                    <div class="flex items-center">
                        <h2 class="text-2xl font-semibold text-white">{{ $header }}</h2>
                    </div>
                    
                    {{-- Perfil del usuario --}}
                    <div class="flex items-center space-x-4" x-data="{ open: false }">
                        <span class="text-white font-medium">{{ Auth::guard('barber')->user()->name }}</span>
                        
                        {{-- Avatar con dropdown --}}
                        <div class="relative">
                            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                                <img src="{{ Auth::guard('barber')->user()->profile_photo_url ?? asset('images/default-profile.png') }}" 
                                     alt="Perfil" 
                                     class="w-10 h-10 rounded-full object-cover border-2 border-white/20 hover:border-white/40 transition-colors">
                                <i class="bi bi-chevron-down text-white transition-transform" :class="{ 'rotate-180': open }"></i>
                            </button>
                            
                            {{-- Dropdown menu --}}
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-[#2A2A2A] rounded-lg shadow-lg border border-white/10 z-50">
                                
                                <a href="{{ route('barber.profile.edit') }}" 
                                   class="block px-4 py-2 text-white hover:bg-white/10 transition-colors">
                                    <i class="bi bi-eye mr-2"></i>Ver perfil
                                </a>
                                
                                <button @click="$dispatch('open-profile-modal')" 
                                        class="w-full text-left block px-4 py-2 text-white hover:bg-white/10 transition-colors">
                                    <i class="bi bi-pencil mr-2"></i>Editar perfil
                                </button>
                                
                                <div class="border-t border-white/10 my-1"></div>
                                
                                <form method="POST" action="{{ route('barber.logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full text-left block px-4 py-2 text-white hover:bg-white/10 transition-colors">
                                        <i class="bi bi-box-arrow-right mr-2"></i>Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>
            @endisset

            {{-- CONTENIDO --}}
            <main class="p-6 mt-0 md:mt-[16px]">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Modal de perfil --}}
    <x-barber.perfil />

    <script>
        // Función para mostrar toasts de error con SweetAlert2
        window.showErrorToast = function(title) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: title,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                background: '#2A2A2A',
                color: '#ffffff',
                iconColor: '#ef4444'
            });
        };

        // Función para mostrar toasts de éxito
        window.showSuccessToast = function(title) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: title,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#2A2A2A',
                color: '#ffffff',
                iconColor: '#ffffff'
            });
        };
    </script>

    {{-- Mostrar mensaje de éxito si existe --}}
    @if(session('success'))
        <script>
            showSuccessToast('{{ session('success') }}');
        </script>
    @endif

    {{-- Mostrar mensaje de error si existe --}}
    @if(session('error'))
        <script>
            showErrorToast('{{ session('error') }}');
        </script>
    @endif

    @stack('scripts')
</body>
</html>
