<x-auth-layout title="Confirmar Contraseña">
  <x-auth-card>
    <h2 class="text-2xl font-bold text-center mb-6">Confirmar Contraseña</h2>
    
    <p class="text-sm text-gray-300 text-center mb-6">
      Esta es un área segura de la aplicación. Por favor confirma tu contraseña antes de continuar.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium mb-1">Contraseña</label>
            <input type="password" name="password" id="password"
                   class="w-full px-4 py-2 bg-[#444]/50 text-white border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
                   required autocomplete="current-password">
            {{-- Los errores se manejan con SweetAlert --}}
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-white text-[#1E1E1E] px-6 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
                Confirmar
            </button>
        </div>
    </form>
  </x-auth-card>
</x-auth-layout>
