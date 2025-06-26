<x-auth-layout title="Iniciar sesión - Admin">
  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Iniciar Sesión - Administrador</h2>

    <!-- Mensaje de sesión -->
    <x-auth-session-status class="mb-4 text-sm text-green-500 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
      @csrf

      <!-- Campo correo -->
      <div>
        <label for="email" class="block text-sm font-medium mb-1">Correo electrónico</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}"
               class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
               required autofocus autocomplete="username">
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
      </div>

      <!-- Contraseña -->
      <div>
        <label for="password" class="block text-sm font-medium mb-1">Contraseña</label>
        <input type="password" name="password" id="password"
               class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
               required autocomplete="current-password">
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
      </div>

      <!-- Recordarme -->
      <div class="flex justify-between items-center text-sm">
        <label class="flex items-center gap-2">
          <input type="checkbox" name="remember" class="accent-white">
          Recordarme
        </label>
        @if (Route::has('admin.password.request'))
          <a href="{{ route('admin.password.request') }}" class="text-white hover:underline">
            ¿Olvidaste tu contraseña?
          </a>
        @endif
      </div>

      <!-- Botón de login -->
      <div class="flex justify-end">
        <x-auth-button>Iniciar sesión</x-auth-button>
      </div>
    </form>
  </x-auth-card>
</x-auth-layout>
