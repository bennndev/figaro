<x-auth-layout title="Inicio de sesión - Barbero">
  <!-- Botón volver -->
  <a href="{{ url('/') }}" class="absolute top-6 left-6 z-10 flex items-center gap-2 text-white hover:text-gray-300 transition-colors duration-200">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
    </svg>
    <span class="text-sm font-medium">Volver</span>
  </a>

  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Inicio de sesión - Barbero</h2>

    {{-- Los mensajes de sesión se manejan con SweetAlert en el layout --}}

    <form method="POST" action="{{ route('barber.login') }}" class="space-y-5">
      @csrf

      <!-- Correo -->
      <x-auth-input
        id="email"
        name="email"
        type="email"
        label="Correo electrónico"
        :value="old('email')"
        required
        autofocus
        autocomplete="username"
      />
      {{-- Los errores se manejan con SweetAlert en el layout --}}

      <!-- Contraseña -->
      <x-auth-input
        id="password"
        name="password"
        type="password"
        label="Contraseña"
        required
        autocomplete="current-password"
      />
      {{-- Los errores se manejan con SweetAlert en el layout --}}

      <!-- Recordarme y enlace olvidar contraseña -->
      <div class="flex justify-between items-center text-sm">
        <label class="flex items-center gap-2">
          <input type="checkbox" name="remember" class="accent-white">
          Recordarme
        </label>

        @if (Route::has('barber.password.request'))
          <a class="text-white hover:underline" href="{{ route('barber.password.request') }}">
            ¿Olvidaste tu contraseña?
          </a>
        @endif
      </div>

      <!-- Botón -->
      <div class="flex justify-end">
        <x-auth-button>Iniciar sesión</x-auth-button>
      </div>
    </form>
  </x-auth-card>
</x-auth-layout>
