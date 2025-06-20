<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Barbero</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons (opcional) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Vite (Tailwind + JS personalizados) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body {
            height: 100%;
            overflow-y: auto;
        }

        /* Fix para el ícono del botón hamburguesa */
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        /* Solución al bug de colapso Bootstrap + Tailwind */
        .collapse:not(.show) {
            display: none !important;
        }
        .collapse.show {
            display: block !important;
        }
    </style>
</head>
<body class="bg-dark text-white position-relative min-vh-100 d-flex flex-column">

    {{-- Imagen de fondo --}}
    <img src="/images/fondo-barberia.jpg"
         alt="Fondo Barbería"
         class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
         style="z-index: -1; filter: blur(5px) brightness(0.4);">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg" style="background-color: rgba(42, 42, 42, 0.85); z-index: 10;">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="/">El Rincón del Barbero</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="/">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/login">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/register">Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Contenido --}}
    <main class="py-5 container flex-grow-1 position-relative" style="z-index: 10;">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center position-relative mt-auto" style="background-color: rgba(42, 42, 42, 0.85); color: #FFFFFF; padding: 1rem; z-index: 10;">
        © 2025 El Rincón del Barbero
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
