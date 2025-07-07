<section class="mt-10">
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Actualizar Contraseña del Barbero') }}
        </h2>

        <p class="mt-1 text-sm text-white/70">
            {{ __('Asegúrate de que tu cuenta use una contraseña larga y aleatoria para mayor seguridad.') }}
        </p>
    </header>

    <form method="post" action="{{ route('barber.password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Contraseña actual --}}
        <div>
            <label for="update_password_current_password" class="block mb-1 text-sm text-white">Contraseña actual</label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400" />
        </div>

        {{-- Nueva contraseña --}}
        <div>
            <label for="update_password_password" class="block mb-1 text-sm text-white">Nueva contraseña</label>
            <input id="update_password_password" name="password" type="password"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400" />
        </div>

        {{-- Confirmar nueva contraseña --}}
        <div>
            <label for="update_password_password_confirmation" class="block mb-1 text-sm text-white">Confirmar contraseña</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>
        

        {{-- Botón Guardar --}}
        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-5 py-2 bg-white text-[#2A2A2A] font-semibold rounded-md hover:bg-gray-200 transition">
                Guardar
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400">
                    Guardado.
                </p>
            @endif
        </div>
    </form>
</section>
