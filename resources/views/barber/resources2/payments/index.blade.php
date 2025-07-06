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
                    <x-admin.table>
                        <x-slot name="head">
                            <tr>
                                <th class="px-4 py-2 font-semibold">ID</th>
                                <th class="px-4 py-2 font-semibold">Cliente</th>
                                <th class="px-4 py-2 font-semibold">Reserva</th>
                                <th class="px-4 py-2 font-semibold">Monto</th>
                                <th class="px-4 py-2 font-semibold">Estado</th>
                                <th class="px-4 py-2 font-semibold">Fecha</th>
                                <th class="px-4 py-2 font-semibold text-center">Acciones</th>
                            </tr>
                        </x-slot>

                        @foreach ($payments as $payment)
                            <tr class="hover:bg-[#FFFFFF]/20 transition">
                                <td class="px-4 py-2">{{ $payment->id }}</td>
                                <td class="px-4 py-2">
                                    {{ $payment->reservation->user->name ?? 'N/A' }} 
                                    {{ $payment->reservation->user->last_name ?? '' }}
                                </td>
                                <td class="px-4 py-2">
                                    <span class="text-gray-300">Reserva {{ $payment->reservation->id }}</span>
                                    <br>
                                    <span class="text-xs text-gray-400">
                                        {{ $payment->reservation->reservation_date->format('d/m/Y') }} - 
                                        {{ $payment->reservation->reservation_time->format('H:i') }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <span class="font-semibold text-green-400">
                                        S/. {{ number_format($payment->amount / 100, 2) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    @if ($payment->status === 'complete')
                                        <span class="inline-block px-3 py-1 bg-green-600 text-white text-sm font-semibold rounded-full">
                                            Completado
                                        </span>
                                    @elseif ($payment->status === 'open')
                                        <span class="inline-block px-3 py-1 bg-yellow-600 text-white text-sm font-semibold rounded-full">
                                            Abierto
                                        </span>
                                    @else
                                        <span class="inline-block px-3 py-1 bg-red-600 text-white text-sm font-semibold rounded-full">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2 text-center">
                                    {{-- Ver --}}
                                    <a href="{{ route('barber.payments.show', $payment->id) }}" 
                                        class="text-[#FFFFFF] hover:text-[#FFFFFF]/70 transition" 
                                        title="Ver detalle"
                                    >
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </x-admin.table>
                @endif

            </div>
        </div>
    </div>

</x-barber-app-layout>
