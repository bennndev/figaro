<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#1E1E1E] text-white">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md rounded-2xl p-1 bg-white/10 backdrop-blur-md shadow-xl">
        <div class="bg-[#1E1E1E]/90 rounded-2xl p-6 border border-[#d9d9d9]/70">
            {{-- Aquí se inserta el contenido de cada vista --}}
            {{ $slot }}
        </div>
    </div>

</body>
</html>
