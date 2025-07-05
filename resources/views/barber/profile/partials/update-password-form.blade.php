<section>
    <header>
        <h2 class="text-xl font-semibold text-white">
            {{ __('Actualizar Contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-white/70">
            {{ __('Asegúrate de usar una contraseña larga y aleatoria para mantener tu cuenta segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('barber.password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Contraseña actual --}}
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-white mb-1">
                {{ __('Contraseña Actual') }}
            </label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
            @error('current_password', 'updatePassword')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nueva contraseña --}}
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-white mb-1">
                {{ __('Nueva Contraseña') }}
            </label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
            @error('password', 'updatePassword')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirmar contraseña --}}
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-white mb-1">
                {{ __('Confirmar Contraseña') }}
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
            @error('password_confirmation', 'updatePassword')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botón guardar --}}
        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-white text-[#2A2A2A] font-semibold rounded-md px-5 py-2 hover:bg-white/90 transition">
                {{ __('Guardar') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
