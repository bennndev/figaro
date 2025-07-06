<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Pagos de Reservas</span>
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-8 px-4 text-white">
        <div class="flex flex-wrap gap-4 items-end mb-6">
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label for="status" class="block mb-1 text-sm">Estado:</label>
                    <select name="status" id="status" class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" @if(request('status', 'all') == $key) selected @endif>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 mt-4">
                    <button type="submit" class="bg-white text-[#2A2A2A] font-semibold py-2 px-4 rounded shadow flex items-center gap-2 hover:bg-white/80">
                        <i class="bi bi-funnel-fill"></i>
                    </button>
                    <a href="{{ route('admin.payments.index') }}" class="bg-white text-[#2A2A2A] font-semibold py-2 px-4 rounded shadow hover:bg-white/80 flex items-center gap-2">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto rounded-xl shadow-lg bg-[#181818]">
            <table class="min-w-full text-sm">
                <thead class="bg-[#232323] text-white">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Cliente</th>
                        <th class="px-4 py-3">Reserva</th>
                        <th class="px-4 py-3">Servicios</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Fecha de pago</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr class="border-b border-gray-700 hover:bg-[#FFFFFF]/10 transition">
                            <td class="px-4 py-3">{{ $payment->id }}</td>
                            <td class="px-4 py-3">{{ $payment->reservation->user->name ?? '-' }}</td>
                            <td class="px-4 py-3">#{{ $payment->reservation->id ?? '-' }}</td>
                            <td class="px-4 py-3">
                                @if($payment->reservation && $payment->reservation->services)
                                    <ul class="list-disc pl-4">
                                        @foreach($payment->reservation->services as $service)
                                            <li>{{ $service->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-3 font-semibold text-white">S/. {{ number_format($payment->amount / 100, 2) }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $status = $payment->reservation->status ?? null;
                                    $statusLabels = [
                                        'paid' => 'Pagado',
                                        'pending_pay' => 'Pendiente',
                                        'cancelled' => 'Cancelado',
                                        'completed' => 'Completado',
                                    ];
                                    $statusClasses = [
                                        'paid' => 'bg-white text-black',
                                        'pending_pay' => 'bg-gray-700 text-white',
                                        'cancelled' => 'bg-[#232323] text-gray-400 border border-gray-600',
                                        'completed' => 'bg-black text-white',
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded-lg text-xs font-bold {{ $statusClasses[$status] ?? 'bg-gray-800 text-white' }}">
                                    {{ $statusLabels[$status] ?? ucfirst($status) ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $payment->updated_at ? $payment->updated_at->format('d/m/Y H:i') : '-' }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.reservations.show', $payment->reservation->id) }}" title="Ver" class="text-white hover:text-white/70 transition">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('admin.payments.report', $payment->id) }}" target="_blank" title="Descargar PDF" class="text-white hover:text-white/70 transition text-2xl">
                                        <i class="bi bi-filetype-pdf"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-8 text-white/70">No hay pagos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $payments->withQueryString()->links() }}
        </div>
    </div>
</x-admin-app-layout>
