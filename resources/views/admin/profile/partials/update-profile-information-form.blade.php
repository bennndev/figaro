<section>
    <header>
        <h2 class="text-lg font-semibold text-white">
            {{ __('Información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-white/70">
            {{ __('Actualiza la información de tu perfil y dirección de correo electrónico.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Nombre --}}
        <div>
            <label for="name" class="block mb-1 text-sm text-white">Nombre</label>
            <input id="name" name="name" type="text"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Apellido --}}
        <div>
            <label for="last_name" class="block mb-1 text-sm text-white">Apellido</label>
            <input id="last_name" name="last_name" type="text"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('last_name', $user->last_name) }}" required autocomplete="family-name">
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block mb-1 text-sm text-white">Correo electrónico</label>
            <input id="email" name="email" type="email"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-white/70">
                    <p>Tu dirección de correo electrónico no ha sido verificada.</p>
                    <button form="send-verification"
                        class="underline text-sm text-white hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Haz clic aquí para reenviar el correo de verificación.
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-green-400">Se ha enviado un nuevo enlace de verificación a tu correo electrónico.</p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Botón Guardar --}}
        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-5 py-2 bg-white text-[#2A2A2A] font-semibold rounded-md hover:bg-gray-200 transition">
                Guardar
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400">
                    Guardado.
                </p>
            @endif
        </div>
    </form>
</section>
