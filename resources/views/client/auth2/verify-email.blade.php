
<x-auth-layout title="Verificar Correo Electrónico">
    <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-4">
        Verificación de correo
    </h2>

    <div class="mb-4 text-sm text-gray-300">
        Gracias por registrarte. Por favor verifica tu correo electrónico haciendo clic en el enlace que te enviamos.  
        Si no lo recibiste, podemos enviarte otro.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-400">
            Se ha enviado un nuevo enlace de verificación al correo proporcionado durante el registro.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                Enviar correo de verificación
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-400 hover:text-white transition">
                Cerrar sesión
            </button>
        </form>
    </div>
  </x-auth-card>
</x-auth-layout>
