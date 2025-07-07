<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Panel de Administración</span>
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 space-y-6">
            
            {{-- Mensaje de bienvenida común --}}
            <div class="bg-[#2A2A2A] text-white rounded-xl shadow-lg p-8 border border-white/10">
                <div class="text-center md:text-left">
                    <h1 class="text-3xl font-bold text-white mb-2">Panel de Administración</h1>
                    <p class="text-lg text-gray-300">Bienvenido a tu panel de administrador.</p>
                    <p class="text-gray-300">Gestiona y supervisa todas las operaciones de <span class="font-bold text-white">Figaro Barbería</span>.</p>
                </div>
            </div>
            {{-- Estadísticas principales --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow border border-white/10">
                    <div class="bg-[#1E1E1E] rounded-lg p-4 flex flex-col items-center">
                        <i class="bi bi-calendar-event text-4xl text-white mb-2"></i>
                        <div class="text-3xl font-bold">{{ $kpis['reservas_hoy'] }}</div>
                        <div class="text-sm text-gray-400 mt-2">Reservas hoy</div>
                    </div>
                </div>
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow border border-white/10">
                    <div class="bg-[#1E1E1E] rounded-lg p-4 flex flex-col items-center">
                        <i class="bi bi-cash-stack text-4xl text-white mb-2"></i>
                        <div class="text-3xl font-bold">S/. {{ number_format($kpis['ingresos_hoy'], 2) }}</div>
                        <div class="text-sm text-gray-400 mt-2">Ingresos hoy</div>
                    </div>
                </div>
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow border border-white/10">
                    <div class="bg-[#1E1E1E] rounded-lg p-4 flex flex-col items-center">
                        <i class="bi bi-people text-4xl text-white mb-2"></i>
                        <div class="text-3xl font-bold">{{ $kpis['clientes'] }}</div>
                        <div class="text-sm text-gray-400 mt-2">Clientes</div>
                    </div>
                </div>
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow border border-white/10">
                    <div class="bg-[#1E1E1E] rounded-lg p-4 flex flex-col items-center">
                        <i class="bi bi-scissors text-4xl text-white mb-2"></i>
                        <div class="text-3xl font-bold">{{ $kpis['barberos'] }}</div>
                        <div class="text-sm text-gray-400 mt-2">Barberos</div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Gráfica de reservas --}}
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow border border-white/10">
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <i class="bi bi-graph-up"></i> Reservas últimos 14 días
                    </h3>
                    <canvas id="reservasChart" height="120"></canvas>
                </div>
                
                {{-- Últimas reservas --}}
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow border border-white/10">
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <i class="bi bi-clock-history"></i> Últimas reservas
                    </h3>
                    <div class="bg-[#1E1E1E] rounded-lg p-4 space-y-3">
                        @foreach($ultimas as $r)
                            <div class="bg-[#2A2A2A] rounded-lg p-3">
                                <div class="flex justify-between items-center mb-2">
                                    <div>
                                        <span class="font-bold text-white">#{{ $r->id }}</span>
                                        <span class="text-gray-300 ml-2">{{ $r->user->name }}</span>
                                    </div>
                                    <span class="text-gray-400 text-sm">{{ $r->reservation_date->format('d/m/Y') }}</span>
                                </div>
                                <div>
                                    <span class="text-xs px-2 py-1 rounded-lg font-bold
                                        @if($r->status === 'paid') bg-white text-black @elseif($r->status === 'pending_pay') bg-gray-700 text-white @elseif($r->status === 'cancelled') bg-[#1E1E1E] text-gray-400 border border-gray-600 @elseif($r->status === 'completed') bg-black text-white @else bg-gray-800 text-white @endif">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- KPIs adicionales --}}
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow border border-white/10">
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <i class="bi bi-bar-chart"></i> Estadísticas del mes
                    </h3>
                    <div class="bg-[#1E1E1E] rounded-lg p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center bg-[#2A2A2A] rounded-lg p-3">
                                <div class="text-2xl font-bold">{{ $kpis['reservas_mes'] }}</div>
                                <div class="text-xs text-gray-400 mt-1">Reservas este mes</div>
                            </div>
                            <div class="text-center bg-[#2A2A2A] rounded-lg p-3">
                                <div class="text-2xl font-bold">S/. {{ number_format($kpis['ingresos_mes'], 2) }}</div>
                                <div class="text-xs text-gray-400 mt-1">Ingresos este mes</div>
                            </div>
                            <div class="text-center bg-[#2A2A2A] rounded-lg p-3">
                                <div class="text-2xl font-bold">{{ $kpis['pendientes'] }}</div>
                                <div class="text-xs text-gray-400 mt-1">Pendientes de pago</div>
                            </div>
                            <div class="text-center bg-[#2A2A2A] rounded-lg p-3">
                                <div class="text-2xl font-bold">{{ $kpis['completadas'] }}</div>
                                <div class="text-xs text-gray-400 mt-1">Completadas</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Top servicios --}}
                <div class="bg-[#2A2A2A] text-white rounded-xl p-6 shadow border border-white/10">
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <i class="bi bi-star"></i> Servicios más populares
                    </h3>
                    <div class="bg-[#1E1E1E] rounded-lg p-4 space-y-3">
                        @foreach($topServicios as $s)
                            <div class="bg-[#2A2A2A] rounded-lg p-3 flex justify-between items-center">
                                <span class="text-white font-medium">{{ $s->name }}</span>
                                <span class="bg-white text-black px-2 py-1 rounded text-sm font-bold">{{ $s->total }}</span>
                            </div>
                        @endforeach
                    </div>
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
