@props(['title' => 'Panel de Administración'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    {{-- Tailwind + Alpine.js --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

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
</body>
</html>
