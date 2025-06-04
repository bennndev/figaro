<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Barbero</title>

    {{-- Tailwind está activo por defecto en Breeze!! --}}

    {{-- Cargamos Bootstrap *DESPUÉS* para evitar que Tailwind desarme el código --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #4A545D !important;
        }

        .navbar-brand,
        .nav-link,
        .navbar-text {
            color: #ffffff !important;
        }

        footer {
            background-color: #4A545D;
            color: #ffffff;
            padding: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>

    {{-- Navbar superior --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">El Rincón del Barbero</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="/registro-cliente">Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <footer>
        © 2025 El Rincón del Barbero. Todos los derechos reservados.
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
