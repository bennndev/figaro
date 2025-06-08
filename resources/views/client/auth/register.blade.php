<x-guest-layout>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        {{ __('Client Register') }}
    </h2>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">Nombre</label>
            <input id="name" name="name" type="text" required autofocus>
        </div>

        <!-- Last Name -->
        <div>
            <label for="last_name">Apellido</label>
            <input id="last_name" name="last_name" type="text" required>
        </div>

        <!-- Email Address -->
        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" required>
        </div>

        <!-- Phone -->
        <div>
            <label for="phone">Teléfono</label>
            <input id="phone" name="phone" type="text">
        </div>

        <!-- Profile Photo -->
        <div>
            <label for="profile_photo">Foto de Perfil</label>
            <input id="profile_photo" name="profile_photo" type="file" accept="image/*">
        </div>

        <!-- Password -->
        <div>
            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" required>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
