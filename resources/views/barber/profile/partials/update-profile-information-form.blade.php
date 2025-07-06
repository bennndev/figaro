<section>
    <header>
        <h3 class="text-lg font-semibold text-white mb-4">Información del Barbero</h3>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('barber.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <label for="name" class="block text-sm font-medium text-white mb-1">Nombre</label>
            <input id="name" name="name" type="text"
                class="block w-full bg-[#1F1F1F] text-white border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                value="{{ old('name', $user->name ?? '') }}" required>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <!-- Apellido -->
        <div>
            <label for="last_name" class="block text-sm font-medium text-white mb-1">Apellido</label>
            <input id="last_name" name="last_name" type="text"
                class="block w-full bg-[#1F1F1F] text-white border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                value="{{ old('last_name', $user->last_name ?? '') }}" required>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('last_name')" />
        </div>

        <!-- Foto de Perfil -->
        <div class="flex flex-col items-center space-y-4">
            <div class="relative">
                <img src="{{ ($user && $user->profile_photo_url) ? $user->profile_photo_url : asset('images/default-profile.png') }}" 
                     alt="Foto de perfil" 
                     class="w-24 h-24 rounded-full object-cover border-4 border-white/20 shadow-lg">
                <label for="profile_photo" 
                       class="absolute bottom-0 right-0 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-2 cursor-pointer transition-colors shadow-lg">
                    <i class="bi bi-camera text-sm"></i>
                </label>
            </div>
            
            <input id="profile_photo" name="profile_photo" type="file" class="hidden" accept="image/*" />
            
            @if ($user && $user->profile_photo)
                <button type="button" 
                        class="text-sm text-red-400 hover:text-red-300 transition-colors"
                        onclick="removePhoto()">
                    <i class="bi bi-trash mr-1"></i>Eliminar foto actual
                </button>
            @endif
            
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('profile_photo')" />
        </div>

        <!-- Correo electrónico -->
        <div>
            <label for="email" class="block text-sm font-medium text-white mb-1">Correo electrónico</label>
            <input id="email" name="email" type="email"
                class="block w-full bg-[#1F1F1F] text-white border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                value="{{ old('email', $user->email ?? '') }}" required>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if ($user && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-white">
                    Tu correo no está verificado.
                    <button form="send-verification" class="underline text-sm text-gray-300 hover:text-white">
                        Haz clic aquí para reenviar el correo de verificación.
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-green-400">
                            Se envió un nuevo enlace de verificación a tu correo.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Especialidades -->
        <div x-data="multiselectDropdown()" x-init="init()" class="relative w-full">
            <label class="block text-sm font-medium text-white mb-2">Especialidades (máx. 3):</label>
            <button @click="toggle" type="button"
                class="w-full bg-[#1E1E1E] text-white border border-gray-600 rounded-md px-4 py-2 flex justify-between items-center">
                <span x-text="selectedLabels.length ? selectedLabels.join(', ') : 'Seleccionar especialidades'"></span>
                <i class="bi bi-chevron-down ml-2"></i>
            </button>

            <div x-show="open" @click.outside="open = false"
                class="absolute z-50 mt-2 w-full bg-[#2A2A2A] text-white rounded-md border border-gray-600 shadow-lg max-h-60 overflow-y-auto">
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
            <label for="phone_number" class="block text-sm font-medium text-white mb-1">Teléfono</label>
            <input id="phone_number" name="phone_number" type="text"
                class="block w-full bg-[#1F1F1F] text-white border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                value="{{ old('phone_number', $user->phone_number ?? '') }}" required>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('phone_number')" />
        </div>

        <!-- Descripción -->
        <div>
            <label for="description" class="block text-sm font-medium text-white mb-1">Descripción</label>
            <textarea id="description" name="description" rows="4"
                class="block w-full bg-[#1F1F1F] text-white border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-blue-500">{{ old('description', $user->description ?? '') }}</textarea>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('description')" />
        </div>

        <!-- Botón -->
        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-white text-[#2A2A2A] font-semibold rounded-md px-5 py-2 hover:bg-white/90 transition">
                Guardar
            </button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400">Guardado.</p>
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
