<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Barbero') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.barbers.update', $barber->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- CSS para ocultar selects no deseados --}}
                        <style>
                            /* Ocultar cualquier select de especialidades que no sea nuestro */
                            select[name*="specialty"]:not([name="specialty_ids_backup[]"]) {
                                display: none !important;
                            }
                            
                            /* Asegurar que nuestros checkboxes se muestren correctamente */
                            input[type="checkbox"][name="specialty_ids[]"] {
                                display: inline-block !important;
                                visibility: visible !important;
                            }
                        </style>

                        {{-- Mostrar todos los errores --}}
                        @if ($errors->any())
                            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                <strong>Se encontraron los siguientes errores:</strong>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Nombre --}}
                        <div style="margin-bottom: 20px;">
                            <label for="name">Nombre:</label><br>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $barber->name) }}" required
                                style="width: 100%; padding: 8px; margin-top: 5px;">
                            @error('name')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Apellido --}}
                        <div style="margin-bottom: 20px;">
                            <label for="last_name">Apellido:</label><br>
                            <input type="text" id="last_name" name="last_name"
                                value="{{ old('last_name', $barber->last_name) }}" required
                                style="width: 100%; padding: 8px; margin-top: 5px;">
                            @error('last_name')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div style="margin-bottom: 20px;">
                            <label for="email">Email:</label><br>
                            <input type="email" id="email" name="email"
                                value="{{ old('email', $barber->email) }}" required
                                style="width: 100%; padding: 8px; margin-top: 5px;">
                            @error('email')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Teléfono --}}
                        <div style="margin-bottom: 20px;">
                            <label for="phone_number">Teléfono:</label><br>
                            <input type="text" id="phone_number" name="phone_number"
                                value="{{ old('phone_number', $barber->phone_number) }}" required
                                style="width: 100%; padding: 8px; margin-top: 5px;">
                            @error('phone_number')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Debug temporal --}}
                        <div style="margin-bottom: 20px; background: #f0f0f0; padding: 10px; color: #000;">
                            <strong>Debug Info:</strong><br>
                            Barbero ID: {{ $barber->id }}<br>
                            Barbero nombre: {{ $barber->name }}<br>
                            Especialidades del barbero (IDs): {{ $barber->specialties->pluck('id')->toArray() | json_encode }}<br>
                            Especialidades del barbero (nombres): {{ $barber->specialties->pluck('name')->toArray() | json_encode }}<br>
                            Total especialidades disponibles: {{ $specialties->count() }}<br>
                            Old specialty_ids: {{ old('specialty_ids', []) | json_encode }}<br>
                            Especialidades seleccionadas por defecto: {{ old('specialty_ids', $barber->specialties->pluck('id')->toArray()) | json_encode }}
                        </div>

                        {{-- Especialidades --}}
                        <div style="margin-bottom: 20px;">
                            <label>Especialidades:</label><br>
                            
                            {{-- Versión con checkboxes para debugging --}}
                            <div style="border: 1px solid #ccc; padding: 10px; margin-top: 5px; max-height: 150px; overflow-y: auto;">
                                @foreach ($specialties as $specialty)
                                    <div style="margin-bottom: 5px;">
                                        <label style="display: flex; align-items: center;">
                                            <input type="checkbox" 
                                                name="specialty_ids[]" 
                                                value="{{ $specialty->id }}"
                                                {{ in_array($specialty->id, old('specialty_ids', $barber->specialties->pluck('id')->toArray())) ? 'checked' : '' }}
                                                style="margin-right: 8px;">
                                            {{ $specialty->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            
                            {{-- Select múltiple como backup (oculto por ahora) --}}
                            <div style="display: none;">
                                <select
                                    id="specialty_ids_select"
                                    name="specialty_ids_backup[]"
                                    multiple
                                    style="width: 100%; padding: 8px; margin-top: 5px; min-height: 120px;"
                                >
                                    @foreach ($specialties as $specialty)
                                        <option value="{{ $specialty->id }}"
                                            {{ in_array($specialty->id, old('specialty_ids', $barber->specialties->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $specialty->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div style="margin-top: 5px; font-size: 12px; color: #666;">
                                Selecciona las especialidades marcando las casillas correspondientes
                            </div>
                            
                            @error('specialty_ids')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div style="margin-bottom: 20px;">
                            <label for="description">Descripción:</label><br>
                            <textarea id="description" name="description" rows="4" required
                                style="width: 100%; padding: 8px; margin-top: 5px;">{{ old('description', $barber->description) }}</textarea>
                            @error('description')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Foto de perfil --}}
                        <div style="margin-bottom: 20px;">
                            <label for="profile_photo">Foto de perfil:</label><br>
                            <input type="file" id="profile_photo" name="profile_photo" accept="image/*"
                                style="margin-top: 5px;">
                            @error('profile_photo')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                            @if ($barber->profile_photo)
                                <div style="margin-top: 10px;">
                                    <img src="{{ asset('storage/' . $barber->profile_photo) }}" alt="Foto de perfil"
                                        style="max-width: 200px; height: auto;">
                                </div>
                            @endif
                        </div>

                        {{-- Contraseña --}}
                        <div style="margin-bottom: 20px;">
                            <label for="password">Contraseña (dejar en blanco para no cambiar):</label><br>
                            <input type="password" id="password" name="password"
                                style="width: 100%; padding: 8px; margin-top: 5px;" autocomplete="new-password">
                            @error('password')
                                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirmar contraseña --}}
                        <div style="margin-bottom: 20px;">
                            <label for="password_confirmation">Confirmar contraseña:</label><br>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                style="width: 100%; padding: 8px; margin-top: 5px;" autocomplete="new-password">
                        </div>

                        <button type="submit"
                            style="padding: 10px 15px; background-color: #1e40af; color: white; border: none; cursor: pointer;"
                            onclick="debugFormData(event)">
                            Actualizar
                        </button>
                    </form>

                    <script>
                    function debugFormData(event) {
                        event.preventDefault(); // Prevenir el envío inicialmente
                        
                        const form = event.target.form;
                        
                        console.log('=== DEBUG FORM DATA ===');
                        console.log('Form action:', form.action);
                        console.log('Form method:', form.method);
                        
                        // Verificar checkboxes de especialidades
                        const specialtyCheckboxes = form.querySelectorAll('input[name="specialty_ids[]"]');
                        const checkedSpecialties = Array.from(specialtyCheckboxes).filter(cb => cb.checked);
                        
                        console.log('Total specialty checkboxes:', specialtyCheckboxes.length);
                        console.log('Checked specialties:', checkedSpecialties.length);
                        console.log('Checked values:', checkedSpecialties.map(cb => cb.value));
                        
                        // Crear FormData
                        const formData = new FormData(form);
                        
                        // Ver todos los datos del formulario
                        console.log('All form data:');
                        for (let [key, value] of formData.entries()) {
                            console.log(`${key}: ${value}`);
                        }
                        
                        // Verificar si specialty_ids[] está en FormData
                        const specialtyIds = formData.getAll('specialty_ids[]');
                        console.log('specialty_ids[] from FormData:', specialtyIds);
                        
                        // Verificar que al menos una especialidad esté seleccionada
                        if (specialtyIds.length === 0) {
                            alert('Debe seleccionar al menos una especialidad');
                            return false;
                        }
                        
                        // Mostrar alerta y preguntar si continuar
                        if (confirm(`Found ${specialtyIds.length} specialties. Debug info logged to console. Check console and click OK to submit form.`)) {
                            form.submit();
                        }
                        
                        return false;
                    }
                    
                    // También agregar evento al cargar la página
                    document.addEventListener('DOMContentLoaded', function() {
                        const checkboxes = document.querySelectorAll('input[name="specialty_ids[]"]');
                        const checkedBoxes = Array.from(checkboxes).filter(cb => cb.checked);
                        console.log('Page loaded - Total checkboxes:', checkboxes.length);
                        console.log('Initially checked:', checkedBoxes.map(cb => cb.value));
                    });
                    </script>

                    <div style="margin-top: 20px;">
                        <a href="{{ route('admin.barbers.index') }}">← Volver al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
