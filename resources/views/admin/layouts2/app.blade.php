@props(['title' => 'Panel de Administración', 'header' => null])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title }}</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

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
}
    </style>
</head>
<body class="bg-[#1E1E1E] text-white min-h-screen" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden relative">

        {{-- SIDEBAR --}}
        <aside 
            class="fixed inset-y-0 left-0 z-50 w-64 bg-[#2A2A2A] p-4 transform transition-transform duration-300 ease-in-out
                   md:relative md:translate-x-0 md:z-0"
            :class="{ '-translate-x-full': !sidebarOpen }"
            x-transition
        >
            <x-admin.sidebar />
        </aside>

        {{-- OVERLAY para móviles --}}
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition.opacity
            x-cloak
        ></div>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="flex-1 flex flex-col w-full overflow-y-auto">

            {{-- HEADER MÓVIL --}}
            <header class="bg-[#1E1E1E] sticky top-0 z-30 shadow-md p-4 flex items-center justify-between md:hidden">
                <button @click="sidebarOpen = true" class="text-white">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <h1 class="ml-4 text-xl font-bold ml-auto">Panel de Administración</h1>
            </header>

            {{-- HEADER ESCRITORIO --}}
            @isset($header)
                <header class="bg-[#1E1E1E] sticky top-0 z-30 p-6 shadow hidden md:flex items-center justify-between">
                    <div class="flex items-center">
                        <h2 class="text-2xl font-semibold text-white">{{ $header }}</h2>
                    </div>

                    {{-- Avatar y dropdown --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                            <span class="text-sm text-white/70 group-hover:text-white transition">{{ Auth::guard('admin')->user()->name }} {{ Auth::guard('admin')->user()->last_name }}</span>
                            <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center border border-gray-500 transition-transform duration-200 transform group-hover:scale-105 group-hover:border-gray-400 shadow-sm">
                                <i class="bi bi-person-fill text-white text-lg"></i>
                            </div>
                        </button>

                        {{-- Dropdown --}}
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-[#2A2A2A] border border-gray-700 rounded-lg shadow-lg z-50">
                            
                            {{-- Botón para ver perfil --}}
                            <a href="{{ route('admin.profile.edit') }}"
                                class="block w-full text-left px-4 py-2 text-sm text-white hover:bg-[#3A3A3A]">
                                Ver perfil
                            </a>
                            {{-- Botón para abrir el modal de edición --}}
                            <button 
                                @click="window.dispatchEvent(new CustomEvent('open-profile-modal')); open = false"
                                class="block w-full text-left px-4 py-2 text-sm text-white hover:bg-[#3A3A3A]">
                                Editar perfil
                            </button>

                            {{-- Logout --}}
                            <form method="POST" action="{{ route('admin.logout') }}">
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

            {{-- CONTENIDO --}}
            <main class="p-6 mt-0 md:mt-[16px]">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Modal del perfil del admin --}}
    <x-admin.perfil />

    {{-- Scripts adicionales --}}
    @stack('scripts')

    {{-- SweetAlert Scripts --}}
    <script>
        // Función para mostrar SweetAlerts
        function showAlert(type, title, text) {
            const config = {
                title: title,
                text: text,
                confirmButtonColor: '#ffffff',
                confirmButtonText: 'Entendido',
                background: '#2A2A2A',
                color: '#ffffff',
                customClass: {
                    confirmButton: 'bg-white text-black font-semibold px-6 py-2 rounded hover:bg-gray-200 transition'
                }
            };

            switch(type) {
                case 'success':
                    Swal.fire({
                        ...config,
                        icon: 'success',
                        iconColor: '#10B981'
                    });
                    break;
                case 'error':
                    Swal.fire({
                        ...config,
                        icon: 'error',
                        iconColor: '#EF4444'
                    });
                    break;
                case 'warning':
                    Swal.fire({
                        ...config,
                        icon: 'warning',
                        iconColor: '#F59E0B'
                    });
                    break;
                case 'info':
                    Swal.fire({
                        ...config,
                        icon: 'info',
                        iconColor: '#3B82F6'
                    });
                    break;
            }
        }

        // Función para mostrar toasts de error
        window.showErrorToast = function(title) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: title,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#2A2A2A',
                color: '#ffffff',
                iconColor: '#EF4444'
            });
        };

        // Función para mostrar toasts de éxito
        window.showSuccessToast = function(title) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: title,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#2A2A2A',
                color: '#ffffff',
                iconColor: '#10B981'
            });
        };

        // Función para confirmación de eliminación
        function confirmDelete(url, itemName = 'este elemento') {
            Swal.fire({
                title: '¿Estás seguro?',
                text: `Se eliminará ${itemName} permanentemente`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: '#2A2A2A',
                color: '#ffffff',
                iconColor: '#F59E0B'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Crear formulario para DELETE
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    
                    // Token CSRF
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (csrfToken) {
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken.getAttribute('content');
                        form.appendChild(csrfInput);
                    }
                    
                    // Method DELETE
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Mostrar mensajes de sesión
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showSuccessToast('{{ session('success') }}');
            @endif

            @if(session('error'))
                showErrorToast('{{ session('error') }}');
            @endif

            @if(session('warning'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: '{{ session('warning') }}',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#2A2A2A',
                    color: '#ffffff',
                    iconColor: '#F59E0B'
                });
            @endif

            @if(session('info'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'info',
                    title: '{{ session('info') }}',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#2A2A2A',
                    color: '#ffffff',
                    iconColor: '#3B82F6'
                });
            @endif

            // Los errores de validación ahora se manejan con toasts individuales en cada modal
        });
    </script>
</body>
</html>
