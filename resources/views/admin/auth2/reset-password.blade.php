<x-auth-layout title="Restablecer Contraseña - Admin">
  <!-- Botón volver -->
  <a href="{{ url('/') }}" class="absolute top-6 left-6 z-10 flex items-center gap-2 text-white hover:text-gray-300 transition-colors duration-200">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
    </svg>
    <span class="text-sm font-medium">Volver</span>
  </a>

  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Restablecer Contraseña</h2>

    <form method="POST" action="{{ route('admin.password.store') }}" class="space-y-5">
      @csrf

      <!-- Token oculto -->
      <input type="hidden" name="token" value="{{ $request->route('token') }}">

      <!-- Correo electrónico -->
      <div>
        <label for="email" class="block text-sm font-medium mb-1">Correo electrónico</label>
        <input type="email" name="email" id="email"
               value="{{ old('email', $request->email) }}"
               class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
               required autofocus autocomplete="username">
        {{-- Los errores se manejan con SweetAlert en el layout --}}
      </div>

      <!-- Nueva contraseña -->
      <div>
        <label for="password" class="block text-sm font-medium mb-1">Nueva contraseña</label>
        <input type="password" name="password" id="password"
               class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
               required autocomplete="new-password">
        {{-- Los errores se manejan con SweetAlert en el layout --}}
      </div>

      <!-- Confirmar contraseña -->
      <div>
        <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
               class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
               required autocomplete="new-password">
        {{-- Los errores se manejan con SweetAlert en el layout --}}
      </div>

      <!-- Botón -->
      <div class="flex justify-end">
        <x-auth-button>Restablecer contraseña</x-auth-button>
      </div>
    </form>
  </x-auth-card>
</x-auth-layout>
