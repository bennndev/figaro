<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Autenticación' }}</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
</body>         
</html>
