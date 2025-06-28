<x-auth-layout title="Verificar correo - Barbero">
  <x-auth-card>

    <h2 class="text-2xl font-bold text-center mb-6">Verifica tu correo electrónico</h2>

    <p class="text-sm text-gray-300 text-center mb-6">
      Gracias por registrarte. Antes de comenzar, por favor verifica tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar. <br>
      Si no lo recibiste, te podemos enviar otro.
    </p>

    @if (session('status') == 'verification-link-sent')
      <div class="mb-4 font-medium text-sm text-green-400 text-center">
        Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
      </div>
    @endif

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
    