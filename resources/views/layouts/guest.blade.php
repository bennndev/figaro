<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#1E1E1E] text-white">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md rounded-2xl p-1 bg-white/10 backdrop-blur-md shadow-xl">
        <div class="bg-[#1E1E1E]/90 rounded-2xl p-6 border border-[#d9d9d9]/70">
            {{-- Aquí se inserta el contenido de cada vista --}}
            {{ $slot }}
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
                        ? implode("\\n", $errorMessages) 
                        : $errorMessages[0];
                @endphp
                showAlert('error', 'Error de validación', '{{ $errorText }}');
            @endif
        });
    </script>

</body>
</html>
