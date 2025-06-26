<x-auth-layout title="Iniciar Sesión">
  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h2>

    {{-- Mensaje de estado de sesión --}}
    @if(session('status'))
      <div class="text-green-400 text-sm mb-3 text-center">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
      @csrf

      {{-- Email --}}
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

      {{-- Password --}}
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

      {{-- Recordarme + Olvidé mi contraseña --}}
      <div class="flex justify-between items-center text-sm">
        <label class="flex items-center gap-2">
          <input type="checkbox" name="remember" class="accent-white">
          Recordarme
        </label>
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-white hover:underline">
            ¿Olvidaste tu contraseña?
          </a>
        @endif
      </div>

      {{-- Botón Iniciar Sesión --}}
      <div class="flex justify-end">
        <x-auth-button>Iniciar sesión</x-auth-button>
      </div>

      {{-- Login con Google --}}
      <div class="flex justify-center mt-5">
  <a href="{{ route('auth.google.redirect') }}"
    class="w-10 h-10 flex items-center justify-center rounded-full border border-white/30 bg-transparent hover:bg-white/10 transition">
    <i class="bi bi-google google-icon text-xl"></i>
  </a>
</div>


    {{-- Registro --}}
    <p class="text-center text-sm mt-5">
      ¿No tienes cuenta?
      <a href="{{ route('register') }}" class="underline">Regístrate aquí</a>
    </p>
  </x-auth-card>
</x-auth-layout>
