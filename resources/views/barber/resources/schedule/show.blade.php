<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Horario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div style="margin-bottom: 20px;">
                    <p><strong>ID:</strong> {{ $schedule->id }}</p>
                    <p><strong>Fecha:</strong> {{ $schedule->date->format('Y-m-d') }}</p>
                    <p><strong>Hora de Inicio:</strong> {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</p>
                    <p><strong>Hora de Fin:</strong> {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</p>
                    <p><strong>Estado:</strong> {{ ucfirst($schedule->status) }}</p>
                </div>

                <div style="margin-top: 20px;">
                    <a href="{{ route('barber.schedules.edit', $schedule->id) }}" style="background-color: #007bff; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;">
                        Editar
                    </a>
                    <a href="{{ route('barber.schedules.index') }}" style="margin-left: 10px; color: #555;">
                        Volver al listado
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-barber-app-layout>
