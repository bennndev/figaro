<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-1">
            <span>Inicio</span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Bienvenida personalizada -->
            <div class="bg-[#2A2A2A] text-white rounded-2xl shadow-lg mb-8 p-8 flex flex-col md:flex-row items-center gap-6">
                <img src="{{ asset('images/imagen.svg') }}" alt="Barbería" class="w-24 h-24 md:w-32 md:h-32 rounded-full shadow-lg border-4 border-[#222] bg-[#181818]">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-1">¡Hola, <span class="text-white">{{ Auth::user()->name }}</span>!</h1>
                    <p class="text-lg text-gray-300">Bienvenido a <span class="font-bold text-white">Figaro Barbería</span>. Reserva tu cita y disfruta de una experiencia única.</p>
                </div>
            </div>

            <!-- Próxima reserva -->
            @if($nextReservation)
            <div class="bg-[#2A2A2A] border-l-4 border-gray-500 rounded-xl p-6 mb-10 flex flex-col md:flex-row items-center justify-between gap-4 shadow">
                <div>
                    <div class="font-semibold text-white mb-1 flex items-center gap-2">
                        <i class="bi bi-calendar-event text-xl text-white"></i> Tu próxima reserva:
                    </div>
                    <div class="text-white text-lg font-bold">{{ $nextReservation->reservation_date->format('d/m/Y') }} a las {{ $nextReservation->reservation_time->format('H:i') }}</div>
                    <div class="text-gray-300 text-sm mt-1">Servicio(s): <span class="font-medium text-white">{{ $nextReservation->services->pluck('name')->join(', ') }}</span></div>
                    <div class="text-gray-300 text-sm">Barbero: <span class="font-medium text-white">{{ $nextReservation->barber->name ?? '-' }} {{ $nextReservation->barber->last_name ?? '' }}</span></div>
                    <div class="text-gray-300 text-sm mt-1">Estado: <span class="font-medium text-white">{{ ucfirst($nextReservation->status) }}</span></div>
                </div>
                <button @click="$dispatch('open-modal-show-reservation-{{ $nextReservation->id }}')" class="bg-[#181818] text-white px-5 py-2 rounded-lg hover:bg-[#222] transition font-semibold flex items-center gap-2 shadow border border-white">
                    <i class="bi bi-eye text-white"></i> Ver detalles
                </button>
                <x-client.modal-show-reservation :reservation="$nextReservation" />
            </div>
            @endif

            <!-- Estadísticas personales -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-[#2A2A2A] rounded-xl p-5 flex flex-col items-center shadow">
                    <i class="bi bi-calendar2-check text-3xl text-white mb-2"></i>
                    <div class="text-2xl font-bold text-white">{{ $stats['total'] }}</div>
                    <div class="text-gray-300 text-sm">Reservas totales</div>
                </div>
                <div class="bg-[#2A2A2A] rounded-xl p-5 flex flex-col items-center shadow">
                    <i class="bi bi-check-circle text-3xl text-white mb-2"></i>
                    <div class="text-2xl font-bold text-white">{{ $stats['completed'] }}</div>
                    <div class="text-gray-300 text-sm">Completadas</div>
                </div>
                <div class="bg-[#2A2A2A] rounded-xl p-5 flex flex-col items-center shadow">
                    <i class="bi bi-x-circle text-3xl text-white mb-2"></i>
                    <div class="text-2xl font-bold text-white">{{ $stats['cancelled'] }}</div>
                    <div class="text-gray-300 text-sm">Canceladas</div>
                </div>
                <div class="bg-[#2A2A2A] rounded-xl p-5 flex flex-col items-center shadow">
                    <i class="bi bi-cash-stack text-3xl text-white mb-2"></i>
                    <div class="text-2xl font-bold text-white">S/. {{ number_format($stats['totalSpent'], 2) }}</div>
                    <div class="text-gray-300 text-sm">Total gastado</div>
                </div>
            </div>

            <!-- Historial de reservas recientes -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2"><i class="bi bi-clock-history text-white"></i> Tus últimas reservas</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-[#2A2A2A] rounded-xl text-white">
                        <thead>
                            <tr class="text-white text-left">
                                <th class="py-2 px-4">Fecha</th>
                                <th class="py-2 px-4">Hora</th>
                                <th class="py-2 px-4">Servicio(s)</th>
                                <th class="py-2 px-4">Barbero</th>
                                <th class="py-2 px-4">Estado</th>
                                <th class="py-2 px-4">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReservations as $reservation)
                                <tr class="border-b border-[#333] hover:bg-[#232b3a]/60 transition">
                                    <td class="py-2 px-4">{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                                    <td class="py-2 px-4">{{ $reservation->reservation_time->format('H:i') }}</td>
                                    <td class="py-2 px-4">{{ $reservation->services->pluck('name')->join(', ') }}</td>
                                    <td class="py-2 px-4">{{ $reservation->barber->name ?? '-' }} {{ $reservation->barber->last_name ?? '' }}</td>
                                    <td class="py-2 px-4">
                                        @if($reservation->status === 'completed' || $reservation->status === 'paid')
                                            <span class="bg-white text-black px-2 py-1 rounded text-xs font-bold">Pagado</span>
                                        @elseif($reservation->status === 'pending_pay')
                                            <span class="bg-gray-700 text-white px-2 py-1 rounded text-xs font-bold">Pendiente de pago</span>
                                        @elseif($reservation->status === 'cancelled')
                                            <span class="bg-red-600 text-white px-2 py-1 rounded text-xs font-bold">Cancelado</span>
                                        @else
                                            <span class="bg-gray-600 text-white px-2 py-1 rounded text-xs font-bold">{{ ucfirst($reservation->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4">
                                        <button @click="$dispatch('open-modal-show-reservation-{{ $reservation->id }}')" class="text-white underline flex items-center gap-1"><i class="bi bi-eye text-white"></i> Ver</button>
                                        <x-client.modal-show-reservation :reservation="$reservation" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-gray-400">No tienes reservas recientes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recomendaciones personalizadas -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2"><i class="bi bi-lightbulb text-white"></i> Te recomendamos</h2>
                <div class="bg-[#2A2A2A] rounded-xl p-6 text-gray-300">
                    ¿No sabes qué elegir? Prueba nuestros servicios destacados o consulta a nuestro <a href="{{ route('client.assistant.index') }}" class="text-white underline font-semibold">asistente virtual</a> para una recomendación personalizada.
                </div>
            </div>

            <!-- Estado de cuenta o pagos pendientes -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2"><i class="bi bi-credit-card-2-front text-white"></i> Estado de cuenta</h2>
                <div class="bg-[#2A2A2A] rounded-xl p-6 text-gray-300">
                    @if($stats['totalSpent'] > 0)
                        ¡Gracias por confiar en nosotros! Puedes ver tus recibos y pagos en la sección <a href="{{ route('client.payments.index') }}" class="text-white underline font-semibold">Pagos</a>.
                    @else
                        No tienes pagos registrados aún.
                    @endif
                </div>
            </div>
        </div>
    </div>
    <x-client.perfil :user="Auth::user()" />

    <!-- Modal de reserva rápida -->
    <div id="quickReservationModal" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center px-4">
        <div class="bg-[#1E1E1E] text-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <button onclick="closeQuickReservationModal()" class="absolute top-3 right-3 text-2xl text-white hover:text-gray-400">&times;</button>
            <h3 class="text-xl font-bold mb-4" id="quickServiceName"></h3>
            <div class="mb-2"><strong>Descripción:</strong> <span id="quickServiceDesc"></span></div>
            <div class="mb-2"><strong>Precio:</strong> S/. <span id="quickServicePrice"></span></div>
            <div class="mb-2"><strong>Duración:</strong> <span id="quickServiceDuration"></span> min</div>
            <div class="mb-2"><strong>Barbero:</strong> <span id="quickServiceBarber"></span></div>
            <form id="quickReservationForm" method="POST" action="{{ route('client.reservations.store') }}">
                @csrf
                <input type="hidden" name="service_id" id="quickServiceId">
                <input type="hidden" name="barber_id" id="quickBarberId">
                <input type="hidden" name="specialty_id" id="quickSpecialtyId">
                <div class="mb-2">
                    <label for="quickDate" class="block text-sm mb-1">Fecha:</label>
                    <input type="date" name="date" id="quickDate" class="w-full bg-[#232323] text-white rounded px-3 py-2 border border-gray-600 focus:outline-none focus:border-white" required min="{{ date('Y-m-d') }}">
                </div>
                <div class="mb-4">
                    <label for="quickTime" class="block text-sm mb-1">Hora:</label>
                    <select name="time" id="quickTime" class="w-full bg-[#232323] text-white rounded px-3 py-2 border border-gray-600 focus:outline-none focus:border-white" required>
                        <option value="">Selecciona una fecha primero</option>
                    </select>
                </div>
                <button type="submit" class="w-full mt-2 bg-white text-black py-2 rounded-lg hover:bg-gray-200 transition font-bold">Reservar y pagar</button>
            </form>
        </div>
    </div>
    @php
        $servicesDataJson = json_encode(
            $servicesData ?? $services->map(function($s) use ($barbers) {
                $barber = $s->barbers->first();
                if (!$barber) {
                    $barber = $barbers->first() ?? null;
                }
                return [
                    'id' => $s->id,
                    'name' => $s->name,
                    'description' => $s->description,
                    'price' => $s->price,
                    'duration' => $s->duration_minutes,
                    'barber' => $barber ? ($barber->name . ' ' . $barber->last_name) : '-',
                    'barber_id' => $barber ? $barber->id : null,
                    'specialty_id' => $s->specialties->first() ? $s->specialties->first()->id : null,
                ];
            })->values()->toArray()
        );
    @endphp
    <script>
        const servicesData = {!! $servicesDataJson !!};
        let selectedService = null;
        function openQuickReservationModal(serviceId) {
            const s = servicesData.find(x => x.id == serviceId);
            selectedService = s;
            document.getElementById('quickServiceName').textContent = s.name;
            document.getElementById('quickServiceDesc').textContent = s.description || 'Sin descripción.';
            document.getElementById('quickServicePrice').textContent = s.price;
            document.getElementById('quickServiceDuration').textContent = s.duration;
            document.getElementById('quickServiceBarber').textContent = s.barber;
            document.getElementById('quickServiceId').value = s.id;
            document.getElementById('quickBarberId').value = s.barber_id;
            document.getElementById('quickSpecialtyId').value = s.specialty_id;
            document.getElementById('quickDate').value = '';
            document.getElementById('quickTime').innerHTML = '<option value="">Selecciona una fecha primero</option>';
            document.getElementById('quickReservationModal').classList.remove('hidden');
        }
        function closeQuickReservationModal() {
            document.getElementById('quickReservationModal').classList.add('hidden');
        }
        // Horarios reales vía AJAX
        document.getElementById('quickDate').addEventListener('change', function() {
            const date = this.value;
            const barberId = selectedService ? selectedService.barber_id : null;
            const serviceId = selectedService ? selectedService.id : null;
            const timeSelect = document.getElementById('quickTime');
            timeSelect.innerHTML = '';
            if (!date || !barberId || !serviceId) {
                timeSelect.innerHTML = '<option value="">Selecciona una fecha primero</option>';
                return;
            }
            // 1. Obtener el schedule_id para ese barbero y fecha
            fetch(`/client/barbers/${barberId}/schedules?date=${date}`)
                .then(res => res.json())
                .then(schedules => {
                    // Normaliza la fecha a YYYY-MM-DD para comparar
                    function normalizeDate(d) {
                        if (!d) return '';
                        if (typeof d === 'string' && d.length === 10) return d;
                        if (typeof d === 'string' && d.includes('T')) return d.split('T')[0];
                        if (d.date) return d.date.split('T')[0];
                        return d;
                    }
                    const schedule = Array.isArray(schedules)
                        ? schedules.find(s => normalizeDate(s.date) === date)
                        : null;
                    if (!schedule) {
                        timeSelect.innerHTML = '<option value="">No hay horarios disponibles</option>';
                        return;
                    }
                    // 2. Pedir los slots disponibles con ese schedule_id
                    fetch('/client/reservations/available-slots', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            barber_id: barberId,
                            services: [serviceId],
                            schedule_id: schedule.id
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (!data || data.length === 0) {
                            timeSelect.innerHTML = '<option value="">No hay horarios disponibles</option>';
                            return;
                        }
                        data.forEach(slot => {
                            const opt = document.createElement('option');
                            opt.value = slot.start;
                            opt.textContent = slot.start + (slot.end ? ' - ' + slot.end : '');
                            timeSelect.appendChild(opt);
                        });
                    })
                    .catch(() => {
                        timeSelect.innerHTML = '<option value="">Error al cargar horarios</option>';
                    });
                })
                .catch(() => {
                    timeSelect.innerHTML = '<option value="">Error al cargar horarios</option>';
                });
        });
        // Adaptar el form para enviar los campos como espera el backend
        document.getElementById('quickReservationForm').addEventListener('submit', function(e) {
            document.getElementById('quickServiceId').setAttribute('name', 'services[]');
            document.getElementById('quickBarberId').setAttribute('name', 'barber_id');
            document.getElementById('quickSpecialtyId').setAttribute('name', 'specialties[]');
            document.getElementById('quickDate').setAttribute('name', 'reservation_date');
            document.getElementById('quickTime').setAttribute('name', 'reservation_time');
        });
    </script>
</x-app-layout>
