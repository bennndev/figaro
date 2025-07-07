<x-auth-layout title="Recuperar contraseña - Admin">
  <!-- Botón volver -->
  <a href="{{ url('/') }}" class="absolute top-6 left-6 z-10 flex items-center gap-2 text-white hover:text-gray-300 transition-colors duration-200">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
    </svg>
    <span class="text-sm font-medium">Volver</span>
  </a>

  <x-auth-card>

    <h2 class="text-2xl font-bold text-center mb-6">¿Olvidaste tu contraseña?</h2>

    <p class="text-sm text-gray-300 text-center mb-6">
      No hay problema. Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
    </p>

    {{-- Los mensajes de sesión se manejan con SweetAlert en el layout --}}

    <form method="POST" action="{{ route('admin.password.email') }}" class="space-y-5">
      @csrf

      <!-- Campo correo -->
      <div>
        <label for="email" class="block text-sm font-medium mb-1">Correo electrónico</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}"
               class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
               required autofocus>
        {{-- Los errores se manejan con SweetAlert en el layout --}}
      </div>

      <!-- Botón enviar -->
      <div class="flex justify-end">
        <x-auth-button>
          Enviar enlace de recuperación
        </x-auth-button>
      </div>
    </form>

    <p class="text-center text-sm mt-6 text-white/70">
      ¿Recordaste tu contraseña?
      <a href="{{ route('admin.login') }}" class="underline">Inicia sesión</a>
    </p>

  </x-auth-card>
</x-auth-layout>
