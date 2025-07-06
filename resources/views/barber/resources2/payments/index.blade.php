<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Mis pagos</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('barber.dashboard') }}" class="text-[#FFFFFF] flex items-center">
                <span>Inicio</span>
            </a>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-[#2A2A2A] text-white shadow-sm sm:rounded-lg px-4 sm:px-6 lg:px-8 py-6">

                <h3 class="text-lg font-semibold mb-4">Listado de tus pagos</h3>

                {{-- Mensaje de éxito --}}
                @if (session('message'))
                    <p class="text-green-400 mb-4">{{ session('message') }}</p>
                @endif

                {{-- Formulario de búsqueda --}}
                <form method="GET" action="{{ route('barber.payments.index') }}"
                      class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">

                    {{-- Cliente --}}
                    <div>
                        <label for="client_name" class="block text-sm font-medium text-white">Cliente:</label>
                        <input type="text" name="client_name" id="client_name" placeholder="Nombre del cliente"
                               value="{{ request('client_name') }}"
                               class="mt-1 bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"/>
                    </div>

                    {{-- Fecha --}}
                    <div>
                        <label for="payment_date" class="block text-sm font-medium text-white">Fecha:</label>
                        <input type="date" name="payment_date" id="payment_date"
                               value="{{ request('payment_date') }}"
                               class="mt-1 bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500"/>
                    </div>

                    {{-- Estado --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-white">Estado:</label>
                        <select name="status" id="status"
                                class="mt-1 bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500">
                            <option value="">-- Todos --</option>
                            <option value="complete" {{ request('status') == 'complete' ? 'selected' : '' }}>Completado</option>
                            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Abierto</option>
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="flex gap-2 mt-5">
                        {{-- Botón Filtrar con ícono --}}
                        <button type="submit"
                                class="flex items-center justify-center gap-2 px-4 py-2 bg-white text-[#2A2A2A] font-semibold rounded shadow hover:bg-white/80 w-fit">
                            <i class="bi bi-funnel-fill"></i>
                        </button>

                        {{-- Botón Limpiar --}}
                        <a href="{{ route('barber.payments.index') }}"
                           class="px-4 py-2 bg-white text-[#2A2A2A] font-semibold rounded shadow hover:bg-white/80 text-center w-fit">
                            Limpiar
                        </a>
                    </div>

                </form>

                @if ($payments->isEmpty())
                    <p class="text-white">No tienes pagos registrados.</p>
                @else
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
                                @foreach ($payments as $payment)
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
                                                $status = $payment->status;
                                                $statusLabels = [
                                                    'complete' => 'Completado',
                                                    'open' => 'Abierto',
                                                ];
                                                $statusClasses = [
                                                    'complete' => 'bg-gray-700 text-white',
                                                    'open' => 'bg-gray-400 text-white',
                                                ];
                                            @endphp
                                            <span class="px-2 py-1 rounded-lg text-xs font-bold {{ $statusClasses[$status] ?? 'bg-gray-800 text-white' }}">
                                                {{ $statusLabels[$status] ?? ucfirst($status) ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">{{ $payment->updated_at ? $payment->updated_at->format('d/m/Y H:i') : '-' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex items-center justify-center space-x-3">
                                                <a href="{{ route('barber.payments.show', $payment->id) }}" class="text-white hover:text-white/70 transition" title="Ver detalle">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{ route('barber.payments.pdf', $payment->id) }}" class="text-white hover:text-white/70 transition text-2xl" title="Descargar recibo PDF" target="_blank">
                                                    <i class="bi bi-filetype-pdf"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>

</x-barber-app-layout>
