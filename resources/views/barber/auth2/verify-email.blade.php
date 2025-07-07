<x-auth-layout title="Verificar correo - Barbero">
  <!-- Botón volver -->
  <a href="{{ url('/') }}" class="absolute top-6 left-6 z-10 flex items-center gap-2 text-white hover:text-gray-300 transition-colors duration-200">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
    </svg>
    <span class="text-sm font-medium">Volver</span>
  </a>

  <x-auth-card>

    <h2 class="text-2xl font-bold text-center mb-6">Verifica tu correo electrónico</h2>

    <p class="text-sm text-gray-300 text-center mb-6">
      Gracias por registrarte. Antes de comenzar, por favor verifica tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar. <br>
      Si no lo recibiste, te podemos enviar otro.
    </p>

    {{-- Los mensajes de sesión se manejan con SweetAlert en el layout --}}

    <div class="mt-6 flex items-center justify-between">
      <!-- Botón reenviar -->
      <form method="POST" action="{{ route('barber.verification.send') }}">
        @csrf
        <x-auth-button>Reenviar correo de verificación</x-auth-button>
      </form>

      <!-- Botón logout -->
      <form method="POST" action="{{ route('barber.logout') }}">
        @csrf
        <button type="submit"
                class="underline text-sm text-gray-300 hover:text-white transition rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
          Cerrar sesión
        </button>
      </form>
    </div>

  </x-auth-card>
</x-auth-layout>
    