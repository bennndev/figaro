<x-auth-layout title="Recuperar contraseña">
  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">¿Olvidaste tu contraseña?</h2>

    <p class="text-sm text-gray-300 text-center mb-6">
      No hay problema. Ingresa tu correo electrónico y te enviaremos un enlace para que puedas restablecerla.
    </p>

    <!-- Mensaje de sesión -->
    <x-auth-session-status class="mb-4 text-sm text-green-500 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
      @csrf

      <!-- Campo correo -->
      <div>
        <label for="email" class="block text-sm font-medium mb-1">Correo electrónico</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}"
               class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
               required autofocus>
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
      </div>

      <!-- Botón enviar -->
      <div class="flex justify-end">
        <button type="submit"
                class="bg-white text-[#1E1E1E] px-6 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
          Enviar enlace de recuperación
        </button>
      </div>
    </form>

    <p class="text-center text-sm mt-6 text-white/70">
      ¿Recordaste tu contraseña?
      <a href="{{ route('login') }}" class="underline">Inicia sesión</a>
    </p>
  </x-auth-card>
</x-auth-layout>
