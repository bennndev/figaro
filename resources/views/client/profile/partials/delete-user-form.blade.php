<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Eliminar cuenta del cliente') }}
        </h2>

        <p class="mt-1 text-sm text-white/70">
            {{ __('Una vez que se elimine tu cuenta, todos sus recursos y datos serán eliminados permanentemente. Antes de eliminarla, por favor descarga cualquier información que desees conservar.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Eliminar cuenta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-[#1F1F1F] rounded-lg">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-white">
                {{ __('¿Estás seguro de que deseas eliminar tu cuenta?') }}
            </h2>

            <p class="mt-1 text-sm text-white/70">
                {{ __('Una vez que se elimine tu cuenta, todos sus recursos y datos serán eliminados permanentemente. Por favor ingresa tu contraseña para confirmar que deseas eliminarla.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-3/4 focus:outline-none focus:border-blue-500"
                    placeholder="{{ __('Contraseña') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button"
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">
                    {{ __('Cancelar') }}
                </button>

                <button type="submit"
                    class="ms-3 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                    {{ __('Eliminar cuenta') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
