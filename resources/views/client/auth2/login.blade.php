<x-auth-layout title="Iniciar Sesión">
  {{-- Botón de volver fuera del contenedor --}}
  <div class="absolute top-6 left-6 z-10">
    <a href="{{ url('/') }}" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
      <i class="bi bi-arrow-left"></i>
      <span class="text-sm">Volver</span>
    </a>
  </div>
  
  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h2>

    {{-- Los mensajes de sesión se manejan con SweetAlert en el layout --}}

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
      {{-- Los errores se manejan con SweetAlert en el layout --}}

      {{-- Password --}}
      <x-auth-input
        id="password"
        name="password"
        type="password"
        label="Contraseña"
        required
        autocomplete="current-password"
      />
      {{-- Los errores se manejan con SweetAlert en el layout --}}

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
        <x-auth-button type="submit" id="loginBtn">Iniciar sesión</x-auth-button>
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
