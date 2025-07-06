<section>
    <header>
        <h3 class="text-lg font-semibold text-white mb-4">
            {{ __('Actualizar Contraseña') }}
        </h3>
        <p class="text-sm text-gray-400 mb-6">
            {{ __('Asegúrate de usar una contraseña larga y aleatoria para mantener tu cuenta segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('barber.password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Contraseña actual --}}
        <div class="space-y-2">
            <label for="update_password_current_password" class="block text-sm font-medium text-white">
                <i class="bi bi-lock mr-2"></i>{{ __('Contraseña Actual') }}
            </label>
            <input id="update_password_current_password" 
                   name="current_password" 
                   type="password" 
                   autocomplete="current-password"
                   placeholder="Ingresa tu contraseña actual"
                   class="bg-[#1F1F1F] text-white border border-gray-600 rounded-lg px-4 py-3 w-full focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" />
            @error('current_password', 'updatePassword')
                <p class="text-sm text-red-400 mt-2 flex items-center">
                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        {{-- Nueva contraseña --}}
        <div class="space-y-2">
            <label for="update_password_password" class="block text-sm font-medium text-white">
                <i class="bi bi-key mr-2"></i>{{ __('Nueva Contraseña') }}
            </label>
            <input id="update_password_password" 
                   name="password" 
                   type="password" 
                   autocomplete="new-password"
                   placeholder="Ingresa tu nueva contraseña"
                   class="bg-[#1F1F1F] text-white border border-gray-600 rounded-lg px-4 py-3 w-full focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" />
            @error('password', 'updatePassword')
                <p class="text-sm text-red-400 mt-2 flex items-center">
                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        {{-- Confirmar contraseña --}}
        <div class="space-y-2">
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-white">
                <i class="bi bi-check-circle mr-2"></i>{{ __('Confirmar Contraseña') }}
            </label>
            <input id="update_password_password_confirmation" 
                   name="password_confirmation" 
                   type="password" 
                   autocomplete="new-password"
                   placeholder="Confirma tu nueva contraseña"
                   class="bg-[#1F1F1F] text-white border border-gray-600 rounded-lg px-4 py-3 w-full focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" />
            @error('password_confirmation', 'updatePassword')
                <p class="text-sm text-red-400 mt-2 flex items-center">
                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        {{-- Botón guardar --}}
        <div class="flex items-center justify-between pt-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg px-6 py-3 transition-colors flex items-center space-x-2">
                <i class="bi bi-check-circle"></i>
                <span>{{ __('Actualizar Contraseña') }}</span>
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 3000)"
                   class="text-sm text-green-400 flex items-center space-x-1">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ __('Contraseña actualizada correctamente') }}</span>
                </p>
            @endif
        </div>
    </form>
</section>
