@props(['title' => 'Panel de Administración'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    {{-- Tailwind + Alpine.js --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#1E1E1E] text-white min-h-screen" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <div 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-[#2A2A2A] p-4 transform transition-transform duration-300 ease-in-out
                   md:relative md:translate-x-0 md:z-0"
            :class="{ '-translate-x-full': !sidebarOpen }"
            x-transition
        >
            <x-sidebar />
        </div>

        {{-- OVERLAY (solo móviles) --}}
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition.opacity
        ></div>

        {{-- CONTENIDO --}}
        <div class="flex-1 flex flex-col w-full overflow-y-auto">

            {{-- TOPBAR móvil --}}
            <header class="bg-[#1E1E1E] shadow-md p-4 flex items-center justify-between md:hidden">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-white focus:outline-none">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                    <h1 class="ml-4 text-xl font-bold">{{ $title }}</h1>
                </div>
                {{-- Rol en móvil --}}
                <div class="text-white flex items-center gap-2 text-sm font-semibold">
                    <i class="bi bi-briefcase-fill text-lg"></i>
                    <span>Administrador</span>
                </div>
            </header>

            {{-- Rol en escritorio --}}
            <div class="hidden md:flex justify-end items-center p-4 pr-8">
                <span class="text-white flex items-center gap-2 text-lg md:text-xl font-bold">
                    <i class="bi bi-briefcase-fill text-xl md:text-3xl"></i>
                    Administrador
                </span>

            </div>

            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

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
                showAlert('success', '¡Éxito!', '{{ session('success') }}');
            @endif

            @if(session('error'))
                showAlert('error', 'Error', '{{ session('error') }}');
            @endif

            @if(session('warning'))
                showAlert('warning', 'Advertencia', '{{ session('warning') }}');
            @endif

            @if(session('info'))
                showAlert('info', 'Información', '{{ session('info') }}');
            @endif

            @if($errors->any())
                @php
                    $errorMessages = $errors->all();
                    $errorText = count($errorMessages) > 1 
                        ? implode("\n", $errorMessages) 
                        : $errorMessages[0];
                @endphp
                showAlert('error', 'Error de validación', '{{ $errorText }}');
            @endif
        });
    </script>
</body>
</html>
