<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Barbero</title>

    <!-- Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Vite (Tailwind + JS personalizados) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark text-white position-relative overflow-hidden">

    {{-- Imagen de fondo oscura y difuminada --}}
    <img src="/images/fondo-barberia.jpg" 
         alt="Fondo Barbería" 
         class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" 
         style="z-index: -1; filter: blur(5px) brightness(0.4);">

    {{-- Navbar superior --}}
    <nav class="navbar navbar-expand-lg" style="background-color: rgba(42, 42, 42, 0.85); z-index: 10;">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="/">El Rincón del Barbero</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
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

    {{-- Contenido principal --}}
    <main class="py-5 container position-relative" style="z-index: 10;">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center position-relative" style="background-color: rgba(42, 42, 42, 0.85); color: #FFFFFF; padding: 1rem; z-index: 10;">
        © 2025 El Rincón del Barbero
    </footer>

    <!-- Bootstrap JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

