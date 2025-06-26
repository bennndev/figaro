<x-auth-layout title="Verificación de correo - Admin">
  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Verificación de Correo</h2>

    <p class="text-sm text-gray-300 text-center mb-6">
      Gracias por registrarte. Antes de comenzar, por favor verifica tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar. <br>
      Si no recibiste el correo, podemos enviarte otro.
    </p>

    @if (session('status') == 'verification-link-sent')
      <div class="mb-4 text-green-400 text-sm text-center font-medium">
        Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
      </div>
    @endif

    <div class="mt-6 flex flex-col md:flex-row justify-between gap-4">
      <form method="POST" action="{{ route('admin.verification.send') }}" class="w-full md:w-auto">
        @csrf
        <x-auth-button>Reenviar correo de verificación</x-auth-button>
      </form>

      <form method="POST" action="{{ route('admin.logout') }}" class="w-full md:w-auto">
        @csrf
        <button type="submit"
                class="underline text-sm text-white/80 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition">
          Cerrar sesión
        </button>
      </form>
    </div>
  </x-auth-card>
</x-auth-layout>
