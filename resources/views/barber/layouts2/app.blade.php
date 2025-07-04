@props(['title' => 'Panel del Barbero', 'header' => null])

<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Tailwind + Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#1E1E1E] text-white min-h-screen" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-[#2A2A2A] p-4 transform transition-transform duration-300 ease-in-out
                   md:relative md:translate-x-0 md:z-0"
            :class="{ '-translate-x-full': !sidebarOpen }"
            x-transition
        >
            <x-barber.sidebar />
        </aside>

        <!-- Overlay móvil -->
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition.opacity
        ></div>

        <!-- Contenido principal -->
        <div class="flex-1 flex flex-col w-full overflow-y-auto">
            
            <!-- Header móvil -->
            <header class="bg-[#1E1E1E] shadow-md p-4 flex items-center justify-between md:hidden">
                <button @click="sidebarOpen = true" class="text-white">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <h1 class="ml-4 text-xl font-bold">{{ $title }}</h1>
            </header>

            <!-- Header opcional para escritorio -->
            @isset($header)
                <header class="bg-[#1E1E1E] p-6 shadow hidden md:block">
                    <h2 class="text-2xl font-semibold text-white">{{ $header }}</h2>
                </header>
            @endisset

            <!-- Slot principal -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
