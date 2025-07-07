<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'Autenticación' }}</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  
  {{-- SweetAlert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background-color: #1E1E1E;
      font-family: 'DM Sans', sans-serif;
    }
    .glass {
      backdrop-filter: blur(15px);
      background-color: rgba(255, 255, 255, 0.08);
    }
    .google-icon {
      filter: brightness(0) invert(1);
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  
  
  {{ $slot }}
  
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
