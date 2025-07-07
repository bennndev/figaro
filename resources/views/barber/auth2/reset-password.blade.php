<x-auth-layout title="Restablecer Contraseña - Barbero">
  <!-- Botón volver -->
  <a href="{{ url('/') }}" class="absolute top-6 left-6 z-10 flex items-center gap-2 text-white hover:text-gray-300 transition-colors duration-200">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
    </svg>
    <span class="text-sm font-medium">Volver</span>
  </a>

  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Restablecer contraseña</h2>

    <form method="POST" action="{{ route('barber.password.store') }}" class="space-y-5">
      @csrf

      <!-- Token -->
      <input type="hidden" name="token" value="{{ $request->route('token') }}">

      <!-- Email -->
      <x-auth-input
        id="email"
        name="email"
        type="email"
        label="Correo electrónico"
        :value="old('email', $request->email)"
        required
        autofocus
        autocomplete="username"
      />
      {{-- Los errores se manejan con SweetAlert en el layout --}}

      <!-- New Password -->
      <x-auth-input
        id="password"
        name="password"
        type="password"
        label="Nueva contraseña"
        required
        autocomplete="new-password"
      />
      {{-- Los errores se manejan con SweetAlert en el layout --}}

      <!-- Confirm Password -->
      <x-auth-input
        id="password_confirmation"
        name="password_confirmation"
        type="password"
        label="Confirmar nueva contraseña"
        required
        autocomplete="new-password"
      />
      {{-- Los errores se manejan con SweetAlert en el layout --}}

      <!-- Submit -->
      <div class="flex justify-end">
        <x-auth-button>Restablecer contraseña</x-auth-button>
      </div>
    </form>
  </x-auth-card>
</x-auth-layout>
