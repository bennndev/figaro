<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Barbero</title>

    {{-- Vite (carga los estilos y scripts) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark text-white">

    {{-- Barra superior --}}
    <nav class="navbar navbar-expand-lg" style="background-color: #2A2A2A;">
        <div class="container">
            <a class="navbar-brand text-white" href="#">El Rincón del Barbero</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-white" href="/">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/login">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/registro-cliente">Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Contenido principal --}}
    <main class="py-4 container">
        @yield('content')
    </main>

    {{-- Pie de página --}}
    <footer class="text-center" style="background-color: #2A2A2A; color: #FFFFFF; padding: 1rem;">
        © 2025 El Rincón del Barbero
    </footer>
</body>
</html>
