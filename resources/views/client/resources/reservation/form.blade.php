<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Errores globales --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <strong>Se encontraron los siguientes errores:</strong>
                        <ul class="list-disc pl-5 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('client.reservations.store') }}" method="POST">
                    @csrf

                    {{-- Fecha --}}
                    <div class="mb-4">
                        <label for="reservation_date">Fecha:</label>
                        <input type="date" name="reservation_date" id="reservation_date"
                            value="{{ old('reservation_date') }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full p-2 border rounded" required>
                        @error('reservation_date')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Barbero --}}
                    <div class="mb-4">
                        <label for="barber_id">Selecciona un barbero:</label>
                        <select name="barber_id" id="barber_id" class="w-full p-2 border rounded" required>
                            <option value="">-- Elige un barbero --</option>
                            @foreach($barbers as $barber)
                                <option value="{{ $barber->id }}" {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                                    {{ $barber->first_name }} {{ $barber->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('barber_id')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Servicios múltiples --}}
                    <div class="mb-4">
                        <label for="service_id">Servicios:</label>
                        <select name="services[]" id="service_id" multiple required class="w-full p-2 border rounded">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ collect(old('services'))->contains($service->id) ? 'selected' : '' }}>
                                    {{ $service->name }} ({{ $service->duration_minutes }} min)
                                </option>
                            @endforeach
                        </select>
                        @error('services')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Horario --}}
                    <div class="mb-4">
                        <label for="schedule_id">Horario disponible:</label>
                        <select name="schedule_id" id="schedule_id" class="w-full p-2 border rounded" required>
                            <option value="">-- Selecciona un horario --</option>
                        </select>
                        @error('schedule_id')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Slots disponibles --}}
                    <div class="mb-4">
                        <label>Horarios disponibles:</label>
                        <input type="hidden" name="reservation_time" id="reservation_time" required>
                        <div id="bloques-disponibles" class="flex flex-wrap gap-2 mt-2"></div>
                        @error('reservation_time')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nota --}}
                    <div class="mb-4">
                        <label for="note">Notas adicionales:</label>
                        <textarea name="note" id="note" rows="3" class="w-full p-2 border rounded">{{ old('note') }}</textarea>
                        @error('note')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <button id="submit-button" type="submit" class="bg-blue-600 hover:bg-blue-800 text-white py-2 px-4 rounded" disabled>
                        Crear Reservación
                    </button>
                </form>

                <div class="mt-4">
                    <a href="{{ route('client.reservations.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Script para cargar horarios y bloques dinámicos --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('barber_id')?.addEventListener('change', cargarHorarios);
            document.getElementById('reservation_date')?.addEventListener('change', cargarHorarios);
            document.getElementById('service_id')?.addEventListener('change', triggerBusqueda);
            document.getElementById('schedule_id')?.addEventListener('change', triggerBusqueda);

            // Validación final antes de enviar
            document.querySelector('form').addEventListener('submit', function (e) {
                const hora = document.getElementById('reservation_time').value;
                if (!hora) {
                    e.preventDefault();
                    alert('Por favor selecciona un bloque de horario antes de continuar.');
                }
            });
        });

        async function cargarHorarios() {
            const barberId = document.getElementById('barber_id').value;
            const date = document.getElementById('reservation_date').value;
            const select = document.getElementById('schedule_id');

            if (!barberId || !date) return;

            try {
                const response = await fetch(`/client/barbers/${barberId}/schedules?date=${date}`);
                const data = await response.json();
                select.innerHTML = '<option value="">-- Selecciona un horario --</option>';
                data.forEach(horario => {
                    select.innerHTML += `<option value="${horario.id}">${horario.start_time} - ${horario.end_time}</option>`;
                });
            } catch (err) {
                console.error('Error al cargar horarios:', err);
            }
        }

        async function triggerBusqueda() {
            const barberId = document.getElementById('barber_id').value;
            const scheduleId = document.getElementById('schedule_id').value;

            const serviceSelect = document.getElementById('service_id');
            const serviceIds = Array.from(serviceSelect.selectedOptions).map(option => option.value);

            if (barberId && scheduleId && serviceIds.length) {
                cargarBloquesDisponibles(barberId, scheduleId, serviceIds);
            }
        }

        async function cargarBloquesDisponibles(barberId, scheduleId, serviceIds) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            try {
                const response = await fetch(`/client/reservations/available-slots`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        barber_id: barberId,
                        schedule_id: scheduleId,
                        services: serviceIds
                    })
                });

                const bloques = await response.json();
                mostrarBloquesEnInterfaz(bloques);
            } catch (error) {
                console.error('Error al cargar bloques disponibles:', error);
                document.getElementById('bloques-disponibles').innerHTML = '<p class="text-red-600">Error al cargar bloques</p>';
            }
        }

        function mostrarBloquesEnInterfaz(bloques) {
            const contenedor = document.getElementById('bloques-disponibles');
            contenedor.innerHTML = '';
            const oldValue = "{{ old('reservation_time') }}";

            if (bloques.length === 0) {
                contenedor.innerHTML = '<p class="text-gray-500">No hay horarios disponibles</p>';
                return;
            }

            bloques.forEach(bloque => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.textContent = `${bloque.start} - ${bloque.end}`;
                btn.className = 'bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded';

                btn.onclick = () => {
                    document.getElementById('reservation_time').value = bloque.start;
                    document.querySelectorAll('#bloques-disponibles button').forEach(b => b.classList.remove('bg-blue-700'));
                    btn.classList.add('bg-blue-700');
                    document.getElementById('submit-button').disabled = false;
                };

                if (bloque.start === oldValue) {
                    document.getElementById('reservation_time').value = bloque.start;
                    btn.classList.add('bg-blue-700');
                    document.getElementById('submit-button').disabled = false;
                }

                contenedor.appendChild(btn);
            });
        }
    </script>
</x-app-layout>
