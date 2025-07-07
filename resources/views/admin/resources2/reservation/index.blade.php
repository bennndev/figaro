<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>Gestión de Reservas</span>
            <span class="mx-2 text-white">/</span>
            <a href="{{ route('admin.dashboard') }}" class="text-[#FFFFFF] flex items-center">
                <span>Inicio</span>
            </a>
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow-sm sm:rounded-lg p-6 text-white">

                {{-- Mensaje de éxito --}}
                @if (session('success'))
                    <p class="text-green-400 mb-4">
                        {{ session('success') }}
                    </p>
                @endif

                {{-- Filtros --}}
                <form method="GET" action="{{ route('admin.reservations.index') }}" class="mb-6 flex flex-wrap gap-6 items-end">

                    {{-- Cliente --}}
                    <div class="flex flex-col">
                        <label for="client_name" class="mb-1 text-sm text-white">Cliente</label>
                        <input type="text" name="client_name" id="client_name"
                            value="{{ request('client_name') }}"
                            placeholder="Nombre o apellido del cliente"
                            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
                    </div>

                    {{-- Barbero --}}
                    <div class="flex flex-col">
                        <label for="barber_name" class="mb-1 text-sm text-white">Barbero</label>
                        <input type="text" name="barber_name" id="barber_name"
                            value="{{ request('barber_name') }}"
                            placeholder="Nombre o apellido del barbero"
                            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
                    </div>

                    {{-- Fecha --}}
                    <div class="flex flex-col">
                        <label for="reservation_date" class="mb-1 text-sm text-white">Fecha</label>
                        <input type="date" name="reservation_date" id="reservation_date"
                            value="{{ request('reservation_date') }}"
                            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
                    </div>

                    {{-- Estado --}}
                    <div class="flex flex-col">
                        <label for="status" class="mb-1 text-sm text-white">Estado</label>
                        <select name="status" id="status"
                            class="bg-[#1F1F1F] text-white border border-gray-500 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-500">
                            <option value="">Todos los estados</option>
                            @foreach($statuses as $value => $label)
                                <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="flex gap-2 mt-4">
                        <button type="submit"
                            class="bg-white text-[#2A2A2A] font-semibold rounded-md px-4 py-2 hover:bg-white/80 transition flex items-center gap-2">
                            <i class="bi bi-funnel-fill"></i>
                        </button>

                        <a href="{{ route('admin.reservations.index') }}"
                            class="bg-white text-[#2A2A2A] font-semibold rounded-md px-4 py-2 hover:bg-white/80 transition flex items-center gap-2">
                            <span>Limpiar</span>
                        </a>
                    </div>

                </form>

                {{-- Tabla --}}
                @if ($reservations->isEmpty())
                    <p class="text-center text-gray-400 min-h-[200px]">No hay reservas registradas.</p>
                @else
                    <x-admin.table>
                        <x-slot name="head">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Cliente</th>
                                <th class="px-4 py-3">Barbero</th>
                                <th class="px-4 py-3">Fecha</th>
                                <th class="px-4 py-3">Hora</th>
                                <th class="px-4 py-3">Servicios</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Pago</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </x-slot>

                        @foreach ($reservations as $reservation)
                            <tr class="hover:bg-[#FFFFFF]/20">
                                <td class="px-4 py-2">{{ $reservation->id }}</td>
                                <td class="px-4 py-2">
                                    <div class="text-sm font-medium">{{ $reservation->user->name }} {{ $reservation->user->last_name }}</div>
                                    <div class="text-sm text-gray-300">{{ $reservation->user->email }}</div>
                                </td>
                                <td class="px-4 py-2">{{ $reservation->barber->name }} {{ $reservation->barber->last_name }}</td>
                                <td class="px-4 py-2">{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">{{ $reservation->reservation_time->format('H:i') }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($reservation->services as $service)
                                            <span class="bg-[#232323] text-white px-3 py-1 rounded-lg text-xs font-bold border border-gray-300">
                                                {{ $service->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    @if($reservation->status === 'pending')
                                        <span class="bg-gray-700 text-white px-3 py-1 rounded-lg text-xs font-bold">Pendiente</span>
                                    @elseif($reservation->status === 'paid')
                                        <span class="bg-white text-black px-3 py-1 rounded-lg text-xs font-bold">Pagado</span>
                                    @elseif($reservation->status === 'completed')
                                        <span class="bg-black text-white px-3 py-1 rounded-lg text-xs font-bold">Completado</span>
                                    @elseif($reservation->status === 'cancelled')
                                        <span class="bg-[#232323] text-gray-400 border border-gray-600 px-3 py-1 rounded-lg text-xs font-bold">Cancelado</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if($reservation->payment)
                                        <div class="text-sm">S/. {{ number_format($reservation->payment->amount / 100, 2) }}</div>
                                        <div class="text-xs text-gray-300">{{ ucfirst($reservation->payment->status) }}</div>
                                    @else
                                        <span class="text-gray-400">Sin pago</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        {{-- Ver --}}
                                        <a href="{{ route('admin.reservations.show', $reservation->id) }}" 
                                           title="Ver"
                                           class="text-white hover:text-white/70 transition">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-admin.table>
                @endif

                {{-- Contador de resultados --}}
                <div class="mt-4 text-sm text-gray-300">
                    Mostrando {{ $reservations->count() }} reserva(s)
                    @if(request()->hasAny(['client_name', 'barber_name', 'reservation_date', 'status']))
                        con filtros aplicados
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- Estilos para campos de fecha --}}
    <style>
        /* Solo para navegadores WebKit como Chrome, Edge, Brave, Safari */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 1;
        }

        /* Para Firefox: mejora la compatibilidad general */
        input[type="date"] {
            color-scheme: dark;
        }
    </style>
</x-admin-app-layout>
