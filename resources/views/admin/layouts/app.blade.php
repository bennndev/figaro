<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        {{-- SweetAlert2 --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('admin.layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
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
