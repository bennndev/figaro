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

    <form method="post" action="{{ route('barber.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Imagen de Perfil con ícono de lápiz -->
        <div class="relative w-24 h-24">
            <img src="{{ ($user && $user->profile_photo_url) ? $user->profile_photo_url : asset('images/default-profile.png') }}"
                 alt="Foto de perfil actual"
                 class="w-24 h-24 rounded-full object-cover border border-gray-500" />

            <!-- Botón de lápiz superpuesto -->
            <label for="profile_photo"
                   class="absolute bottom-0 right-0 bg-white text-[#2A2A2A] rounded-full p-1 cursor-pointer hover:bg-gray-200 transition shadow-md">
                <i class="bi bi-pencil-fill text-sm"></i>
            </label>
            <input id="profile_photo" name="profile_photo" type="file" accept="image/*" class="hidden" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('profile_photo')" />
        </div>

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-white" />
            <input id="name" name="name" type="text"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('name', $user->name ?? '') }}" required autofocus autocomplete="name">
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <!-- Apellido -->
        <div>
            <x-input-label for="last_name" :value="__('Apellido')" class="text-white" />
            <input id="last_name" name="last_name" type="text"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('last_name', $user->last_name ?? '') }}" required autocomplete="family-name">
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('last_name')" />
        </div>
        <!-- Correo Electrónico -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="text-white" />
            <input id="email" name="email" type="email"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('email', $user->email ?? '') }}" required autocomplete="username">
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if ($user && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
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

        <!-- Especialidades -->
        <!-- Especialidades -->
        <div x-data="multiselectDropdown()" x-init="init()" class="relative w-full">
            <x-input-label for="specialties" :value="__('Especialidades (máx. 3)')" class="text-white" />
            <button @click="toggle" type="button"
                class="w-full bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 flex justify-between items-center focus:outline-none focus:border-blue-500">
                <span x-text="selectedLabels.length ? selectedLabels.join(', ') : 'Seleccionar especialidades'"></span>
                <i class="bi bi-chevron-down ml-2"></i>
            </button>

            <div x-show="open" @click.outside="open = false"
                class="absolute z-50 mt-2 w-full bg-[#2A2A2A] text-white rounded-md border border-gray-500 shadow-lg max-h-60 overflow-y-auto">
                <div class="p-2 space-y-1">
                    @foreach ($specialties as $specialty)
                        <label class="flex items-center space-x-2 px-2 py-1 hover:bg-white/10 rounded">
                            <input type="checkbox"
                                value="{{ $specialty->id }}"
                                x-ref="checkboxes"
                                @change="updateSelection($event)"
                                x-bind:checked="selected.includes({{ $specialty->id }})"
                                class="text-blue-500 bg-transparent border-gray-500 rounded focus:ring-0">
                            <span>{{ $specialty->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <template x-for="id in selected" :key="id">
                <input type="hidden" name="specialties[]" :value="id">
            </template>

            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('specialties')" />
        </div>

        <!-- Teléfono -->
        <div>
            <x-input-label for="phone_number" :value="__('Teléfono')" class="text-white" />
            <input id="phone_number" name="phone_number" type="tel"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"
                value="{{ old('phone_number', $user->phone_number ?? '') }}" autocomplete="tel">
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('phone_number')" />
        </div>

        <!-- Descripción -->
        <div>
            <x-input-label for="description" :value="__('Descripción')" class="text-white" />
            <textarea id="description" name="description" rows="4"
                class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500">{{ old('description', $user->description ?? '') }}</textarea>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('description')" />
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


<!-- Script para multiselect -->
<script>
function multiselectDropdown() {
    return {
        open: false,
        selected: @json(old('specialties', ($user && $user->specialties) ? $user->specialties->pluck('id')->toArray() : [])),
        selectedLabels: [],
        toggle() {
            this.open = !this.open;
        },
        updateSelection(event) {
            const id = parseInt(event.target.value);
            const label = event.target.nextElementSibling.innerText;

            if (event.target.checked) {
                if (this.selected.length < 3) {
                    this.selected.push(id);
                    this.selectedLabels.push(label);
                } else {
                    event.target.checked = false;
                    alert('Solo puedes seleccionar hasta 3 especialidades.');
                }
            } else {
                this.selected = this.selected.filter(i => i !== id);
                this.selectedLabels = this.selectedLabels.filter(l => l !== label);
            }
        },
        init() {
            const selectedFromServer = @json(($user && $user->specialties) ? $user->specialties->map(fn($s) => ['id' => $s->id, 'name' => $s->name]) : []);
            this.selectedLabels = selectedFromServer.map(item => item.name);
            this.selected = selectedFromServer.map(item => item.id);
        }
    };
}
</script>
