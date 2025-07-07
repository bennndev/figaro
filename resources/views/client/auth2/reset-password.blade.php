<x-auth-layout title="Restablecer contraseña">
  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Restablecer contraseña</h2>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
      @csrf

      <!-- Token oculto -->
      <input type="hidden" name="token" value="{{ $request->route('token') }}">

      <!-- Correo electrónico -->
      <div>
        <label for="email" class="block text-sm font-medium mb-1">Correo electrónico</label>
        <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}"
               class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
               required autofocus autocomplete="username">
        {{-- Los errores se manejan con SweetAlert --}}
      </div>

      <!-- Nueva contraseña -->
      <div>
        <label for="password" class="block text-sm font-medium mb-1">Nueva contraseña</label>
        <input type="password" name="password" id="password"
               class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
               required autocomplete="new-password">
        {{-- Los errores se manejan con SweetAlert --}}
      </div>

      <!-- Confirmar contraseña -->
      <div>
        <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
               class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
               required autocomplete="new-password">
        {{-- Los errores se manejan con SweetAlert --}}
      </div>

      <!-- Botón -->
      <div class="flex justify-end">
        <button type="submit"
                class="bg-white text-[#1E1E1E] px-6 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
          Restablecer contraseña
        </button>
      </div>
    </form>
  </x-auth-card>
</x-auth-layout>
