<x-auth-layout title="Inicio de sesión - Barbero">
  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Inicio de sesión - Barbero</h2>

    <!-- Mensaje de estado de sesión -->
    <x-auth-session-status class="mb-4 text-sm text-green-500 text-center" :status="session('status')" />

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
      @error('email')
        <small class="text-red-400">{{ $message }}</small>
      @enderror

      <!-- Contraseña -->
      <x-auth-input
        id="password"
        name="password"
        type="password"
        label="Contraseña"
        required
        autocomplete="current-password"
      />
      @error('password')
        <small class="text-red-400">{{ $message }}</small>
      @enderror

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
