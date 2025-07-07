<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Panel de Administración</span>
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4">
            {{-- KPIs --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow flex flex-col items-center border border-white/10">
                    <div class="text-3xl font-bold">{{ $kpis['reservas_hoy'] }}</div>
                    <div class="text-xs text-gray-400 mt-2">Reservas hoy</div>
                </div>
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow flex flex-col items-center border border-white/10">
                    <div class="text-3xl font-bold">S/. {{ number_format($kpis['ingresos_hoy'], 2) }}</div>
                    <div class="text-xs text-gray-400 mt-2">Ingresos hoy</div>
                </div>
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow flex flex-col items-center border border-white/10">
                    <div class="text-3xl font-bold">{{ $kpis['clientes'] }}</div>
                    <div class="text-xs text-gray-400 mt-2">Clientes</div>
                </div>
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow flex flex-col items-center border border-white/10">
                    <div class="text-3xl font-bold">{{ $kpis['barberos'] }}</div>
                    <div class="text-xs text-gray-400 mt-2">Barberos</div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- Gráfica de reservas --}}
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow border border-white/10">
                    <h3 class="font-semibold mb-4 text-lg">Reservas últimos 14 días</h3>
                    <canvas id="reservasChart" height="120"></canvas>
                </div>
                {{-- Últimas reservas --}}
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow border border-white/10">
                    <h3 class="font-semibold mb-4 text-lg">Últimas reservas</h3>
                    <ul>
                        @foreach($ultimas as $r)
                            <li class="mb-3 border-b border-gray-700 pb-2">
                                <span class="font-bold">#{{ $r->id }}</span> -
                                {{ $r->user->name }}
                                <span class="text-gray-400">({{ $r->reservation_date->format('d/m/Y') }})</span>
                                <span class="ml-2 text-xs px-2 py-1 rounded-lg font-bold
                                    @if($r->status === 'paid') bg-white text-black @elseif($r->status === 'pending_pay') bg-gray-700 text-white @elseif($r->status === 'cancelled') bg-[#2A2A2A] text-gray-400 border border-gray-600 @elseif($r->status === 'completed') bg-black text-white @else bg-gray-800 text-white @endif">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- KPIs adicionales --}}
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow mb-8 border border-white/10">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="text-2xl font-bold">{{ $kpis['reservas_mes'] }}</div>
                            <div class="text-xs text-gray-400 mt-1">Reservas este mes</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">S/. {{ number_format($kpis['ingresos_mes'], 2) }}</div>
                            <div class="text-xs text-gray-400 mt-1">Ingresos este mes</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">{{ $kpis['pendientes'] }}</div>
                            <div class="text-xs text-gray-400 mt-1">Pendientes de pago</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">{{ $kpis['completadas'] }}</div>
                            <div class="text-xs text-gray-400 mt-1">Completadas</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">{{ $kpis['canceladas'] }}</div>
                            <div class="text-xs text-gray-400 mt-1">Canceladas</div>
                        </div>
                    </div>
                </div>
                {{-- Top servicios --}}
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow mb-8 border border-white/10">
                    <h3 class="font-semibold mb-4 text-lg">Servicios más reservados</h3>
                    <ul>
                        @foreach($topServicios as $s)
                            <li class="mb-2 flex justify-between border-b border-gray-700 pb-1">
                                <span>{{ $s->name }}</span>
                                <span class="font-bold">{{ $s->total }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('reservasChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chart['labels']),
                datasets: [{
                    label: 'Reservas',
                    data: @json($chart['values']),
                    borderColor: '#fff',
                    backgroundColor: 'rgba(255,255,255,0.1)',
                    tension: 0.3,
                    pointBackgroundColor: '#fff',
                    pointRadius: 4,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#ccc' }, grid: { color: '#333' } },
                    y: { ticks: { color: '#ccc' }, grid: { color: '#333' } }
                }
            }
        });
    </script>
</x-admin-app-layout>
