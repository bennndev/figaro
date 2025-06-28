@extends('layouts.app')

@section('title', 'Tipo de Usuario')

@section('content')

  <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <!-- TÍTULO -->
    <h2 class="text-5xl font-bold mb-14 text-center text-white">¿Qué tipo de usuario eres?</h2>

    <div class="flex flex-wrap justify-center gap-6">

      <!-- CLIENTE -->
      @auth
        <a href="{{ url('dashboard') }}"
           class="group bg-[#2A2A2A]/50 text-white w-64 h-80 rounded-xl border border-gray-300 shadow-lg transition-transform hover:scale-105 duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white px-5 py-6 text-left block">
          <h3 class="text-3xl font-bold mb-2">Cliente</h3>
          <p class="text-base text-white/90 mb-4">Reserva tus citas.</p>
          <div class="w-full flex flex-col items-center">
            <i class="bi bi-person-fill text-[140px] text-white group-hover:scale-110 transition-transform"></i>
            <p class="mt-3 text-white font-semibold text-sm">Sesión iniciada</p>
          </div>
        </a>
      @else
        <a href="{{ route('login') }}"
           class="group bg-[#2A2A2A]/50 text-white w-64 h-80 rounded-xl border border-gray-300 shadow-lg transition-transform hover:scale-105 duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white px-5 py-6 text-left block">
          <h3 class="text-3xl font-bold mb-2">Cliente</h3>
          <p class="text-base text-white/90 mb-4">Reserva tus citas.</p>
          <div class="w-full flex justify-center">
            <i class="bi bi-person-fill text-[140px] text-white group-hover:scale-110 transition-transform"></i>
          </div>
        </a>
      @endauth

      <!-- BARBERO -->
      @auth('barber')
        <a href="{{ url('barber/dashboard') }}"
           class="group bg-[#2A2A2A]/50 text-white w-64 h-80 rounded-xl border border-gray-300 shadow-lg transition-transform hover:scale-105 duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white px-5 py-6 text-left block">
          <h3 class="text-3xl font-bold mb-2">Barbero</h3>
          <p class="text-base text-white/90 mb-4">Gestiona tus horarios.</p>
          <div class="w-full flex flex-col items-center">
            <i class="bi bi-scissors text-[140px] text-white group-hover:scale-110 transition-transform"></i>
            <p class="mt-3 text-white font-semibold text-sm">Sesión iniciada</p>
          </div>
        </a>
      @else
        <a href="{{ route('barber.login') }}"
           class="group bg-[#2A2A2A]/50 text-white w-64 h-80 rounded-xl border border-gray-300 shadow-lg transition-transform hover:scale-105 duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white px-5 py-6 text-left block">
          <h3 class="text-3xl font-bold mb-2">Barbero</h3>
          <p class="text-base text-white/90 mb-4">Gestiona tus horarios.</p>
          <div class="w-full flex justify-center">
            <i class="bi bi-scissors text-[140px] text-white group-hover:scale-110 transition-transform"></i>
          </div>
        </a>
      @endauth

      <!-- ADMIN -->
      @auth('admin')
        <a href="{{ url('admin/dashboard') }}"
           class="group bg-[#2A2A2A]/50 text-white w-64 h-80 rounded-xl border border-gray-300 shadow-lg transition-transform hover:scale-105 duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white px-5 py-6 text-left block">
          <h3 class="text-3xl font-bold mb-2">Administrador</h3>
          <p class="text-base text-white/90 mb-4">Control total del sistema.</p>
          <div class="w-full flex flex-col items-center">
            <i class="bi bi-briefcase-fill text-[140px] text-white group-hover:scale-110 transition-transform"></i>
            <p class="mt-3 text-white font-semibold text-sm">Sesión iniciada</p>
          </div>
        </a>
      @else
        <a href="{{ route('admin.login') }}"
           class="group bg-[#2A2A2A]/50 text-white w-64 h-80 rounded-xl border border-gray-300 shadow-lg transition-transform hover:scale-105 duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white px-5 py-6 text-left block">
          <h3 class="text-3xl font-bold mb-2">Administrador</h3>
          <p class="text-base text-white/90 mb-4">Control total del sistema.</p>
          <div class="w-full flex justify-center">
            <i class="bi bi-briefcase-fill text-[140px] text-white group-hover:scale-110 transition-transform"></i>
          </div>
        </a>
      @endauth

    </div>

  </body>

@endsection
