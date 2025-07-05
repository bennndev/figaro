@props(['title' => 'Panel del Barbero', 'header' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FullCalendar --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.js"></script>

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

    {{-- Tailwind y Alpine.js --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
        [x-cloak] {
            display: none !important;
        }
        input[type="date"],
    input[type="time"],
    select {
        background-color: #1F1F1F;
        color: white;
        border: 1px solid #555;
    }

    input[type="date"]::-webkit-calendar-picker-indicator,
    input[type="time"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
        opacity: 0.8;
    }

    input[type="date"]:hover::-webkit-calendar-picker-indicator,
    input[type="time"]:hover::-webkit-calendar-picker-indicator {
        opacity: 1;
    }

    /* Placeholder blanco para campos vacíos */
    input::placeholder {
        color: #ccc;
    }
    </style>
</head>

<body class="bg-[#1E1E1E] text-white min-h-screen" x-data="{ sidebarOpen: false }" :class="{ 'overflow-hidden': sidebarOpen }">
    <div class="flex h-screen overflow-hidden relative">

        {{-- SIDEBAR --}}
        <aside 
            class="fixed inset-y-0 left-0 z-40 w-64 bg-[#2A2A2A] p-4 transform transition-transform duration-300 ease-in-out
                   md:relative md:translate-x-0 md:z-0"
            :class="{ '-translate-x-full': !sidebarOpen }"
            x-transition
        >
            <x-barber.sidebar />
        </aside>

        {{-- OVERLAY MÓVIL --}}
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition.opacity
        ></div>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="flex-1 flex flex-col w-full overflow-y-auto z-0 relative">

            {{-- HEADER MÓVIL --}}
            <header class="bg-[#1E1E1E] sticky top-0 z-20 shadow-md p-4 flex items-center justify-between md:hidden">
                <button @click="sidebarOpen = true" class="text-white">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <h1 class="ml-4 text-xl font-bold ml-auto">Panel del Barbero</h1>
            </header>

            {{-- HEADER ESCRITORIO --}}
            @isset($header)
                <header class="bg-[#1E1E1E] sticky top-0 z-20 p-6 shadow hidden md:flex items-center justify-between">
                    <div class="flex items-center">
                        <h2 class="text-2xl font-semibold text-white">{{ $header }}</h2>
                    </div>
                </header>
            @endisset

            {{-- CONTENIDO --}}
            <main class="p-6 mt-0 md:mt-[16px]">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
