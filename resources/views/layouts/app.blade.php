<!DOCTYPE html>
<html lang="es">
<head>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', config('app.name', 'Laravel'))</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Fuentes -->
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'DM Sans', sans-serif;
      background-color: #1E1E1E;
    }
  </style>
</head>
<body class="text-white min-h-screen overflow-x-hidden bg-[#1E1E1E] relative">

  <!-- CENTRADO GLOBAL -->
  <div class="flex flex-col items-center justify-center w-full">

    <!-- ÍCONO SVG -->
    <div class="w-full flex justify-center my-8">
      <img src="{{ asset('images/imagen.svg') }}" alt="Ícono" class="w-40 h-40 drop-shadow-xl">
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="w-full max-w-7xl px-4 z-20">
      @yield('content')
    </main>

  </div>

  @yield('scripts')
</body>
</html>
