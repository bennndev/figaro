@props(['barbers'])

<div 
    x-show="showScheduleModal" 
    x-transition 
    x-cloak 
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
    style="display: none;"
>
    <div class="bg-[#2A2A2A] text-white w-full max-w-2xl rounded-2xl shadow-2xl p-6 relative overflow-y-auto max-h-[90vh] custom-scroll">

        <!-- Botón cerrar -->
        <button 
            @click="showScheduleModal = false"
            class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl font-bold"
        >
            &times;
        </button>

        <h2 class="text-2xl font-bold mb-6">Crear nuevo horario</h2>

        <form method="POST" action="{{ route('admin.schedules.store') }}">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium">Nombre del horario</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-3 py-2 border rounded bg-[#1F1F1F] border-white/20 focus:outline-none focus:ring-2 focus:ring-white/30">
                    @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="barber_id" class="block text-sm font-medium">Barbero</label>
                    <select name="barber_id" id="barber_id" required
                        class="w-full px-3 py-2 border rounded bg-[#1F1F1F] border-white/20 focus:outline-none focus:ring-2 focus:ring-white/30">
                        <option value="">Seleccione un barbero</option>
                        @foreach ($barbers as $barber)
                            <option value="{{ $barber->id }}" {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                                {{ $barber->first_name }} {{ $barber->last_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('barber_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium">Fecha</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" required
                        class="w-full px-3 py-2 border rounded bg-[#1F1F1F] border-white/20 focus:outline-none focus:ring-2 focus:ring-white/30">
                    @error('date') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="start_time" class="block text-sm font-medium">Hora de inicio</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" required
                        class="w-full px-3 py-2 border rounded bg-[#1F1F1F] border-white/20 focus:outline-none focus:ring-2 focus:ring-white/30">
                    @error('start_time') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="end_time" class="block text-sm font-medium">Hora de fin</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" required
                        class="w-full px-3 py-2 border rounded bg-[#1F1F1F] border-white/20 focus:outline-none focus:ring-2 focus:ring-white/30">
                    @error('end_time') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium">Estado</label>
                    <select name="status" id="status" required
                        class="w-full px-3 py-2 border rounded bg-[#1F1F1F] border-white/20 focus:outline-none focus:ring-2 focus:ring-white/30">
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                        <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>Reservado</option>
                    </select>
                    @error('status') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
