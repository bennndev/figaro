<x-auth-layout title="Restablecer Contraseña - Barbero">
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
      @error('email')
        <small class="text-red-400">{{ $message }}</small>
      @enderror

      <!-- New Password -->
      <x-auth-input
        id="password"
        name="password"
        type="password"
        label="Nueva contraseña"
        required
        autocomplete="new-password"
      />
      @error('password')
        <small class="text-red-400">{{ $message }}</small>
      @enderror

      <!-- Confirm Password -->
      <x-auth-input
        id="password_confirmation"
        name="password_confirmation"
        type="password"
        label="Confirmar nueva contraseña"
        required
        autocomplete="new-password"
      />
      @error('password_confirmation')
        <small class="text-red-400">{{ $message }}</small>
      @enderror

      <!-- Submit -->
      <div class="flex justify-end">
        <x-auth-button>Restablecer contraseña</x-auth-button>
      </div>
    </form>
  </x-auth-card>
</x-auth-layout>
