<section>
    <header>
        <h2 class="text-lg font-medium text-[#FFFFFF]">
            {{ __('Información del Perfil del Cliente') }}
        </h2>
        <p class="mt-1 text-sm text-white/70">
            {{ __('Actualiza la información de tu cuenta y tu dirección de correo electrónico.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Imagen de Perfil con ícono de lápiz -->
        <div class="flex flex-col items-center mb-6">
            <div class="relative w-32 h-32">
                <img id="profile_image_preview" src="{{ $user->profile_photo_url }}"
                     alt="Foto de perfil actual"
                     class="w-32 h-32 rounded-full object-cover border-2 border-gray-400 shadow-lg" />

                <!-- Botón de lápiz en esquina inferior derecha -->
                <label id="pencil-button" for="profile_photo"
                       class="absolute -bottom-1 -right-1 bg-gray-800 text-white rounded-full p-2 cursor-pointer hover:bg-gray-900 transition-all duration-200 shadow-lg border-2 border-white">
                    <i class="bi bi-pencil-fill text-sm"></i>
                </label>
                <input id="profile_photo" name="profile_photo" type="file" accept="image/*" class="hidden" onchange="previewImage(event)" />
            </div>
            
            <!-- Botón Cambiar (oculto inicialmente) -->
            <button id="change-button" type="button" onclick="document.getElementById('profile_photo').click()" 
                    class="hidden mt-3 px-4 py-2 bg-white text-gray-800 text-sm font-bold rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-md border border-gray-300">
                Cambiar
            </button>
        </div>
        <x-input-error class="mt-2 text-red-400 text-center" :messages="$errors->get('profile_photo')" />
        
        <!-- Mensaje de confirmación -->
        <div id="upload-success-message" class="hidden mt-2 text-green-600 text-center text-sm font-medium">
            ✓ Imagen subida correctamente
        </div>

        <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile_image_preview').src = e.target.result;
                    
                    // Ocultar el botón de lápiz
                    const pencilButton = document.getElementById('pencil-button');
                    pencilButton.classList.add('hidden');
                    
                    // Mostrar el botón "Cambiar"
                    const changeButton = document.getElementById('change-button');
                    changeButton.classList.remove('hidden');
                    
                    // Mostrar mensaje de confirmación
                    const successMessage = document.getElementById('upload-success-message');
                    successMessage.classList.remove('hidden');
                    
                    // Ocultar el mensaje después de 3 segundos
                    setTimeout(function() {
                        successMessage.classList.add('hidden');
                    }, 3000);
                };
                reader.readAsDataURL(file);
            }
        }
        </script>



        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-white" />
            <input id="name" name="name" type="text"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <!-- Apellido -->
        <div>
            <x-input-label for="last_name" :value="__('Apellido')" class="text-white" />
            <input id="last_name" name="last_name" type="text"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('last_name', $user->last_name) }}" required autocomplete="family-name">
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('last_name')" />
        </div>

        <!-- Teléfono -->
        <div>
            <x-input-label for="phone_number" :value="__('Teléfono')" class="text-white" />
            <input id="phone_number" name="phone_number" type="tel"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('phone_number', $user->phone_number ?? '') }}" autocomplete="tel">
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('phone_number')" />
        </div>

        <!-- Correo Electrónico -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="text-white" />
            <input id="email" name="email" type="email"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-white/70">
                        {{ __('Tu dirección de correo no está verificada.') }}

                        <button form="send-verification"
                            class="underline text-sm text-white hover:text-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu correo electrónico.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Botón Guardar -->
        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-5 py-2 bg-white text-[#2A2A2A] font-semibold rounded-md hover:bg-gray-200 transition">
                Guardar
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400"
                >Guardado.</p>
            @endif
        </div>
       
    </form>
</section>
