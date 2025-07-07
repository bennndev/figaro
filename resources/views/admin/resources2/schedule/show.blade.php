<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del Horario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 shadow-sm rounded">

            <p><strong>ID:</strong> {{ $schedule->id }}</p>
            <p><strong>Barbero:</strong> {{ $schedule->barber->first_name }} {{ $schedule->barber->last_name }}</p>
            <p><strong>Nombre:</strong> {{ $schedule->name }}</p>
            <p><strong>Fecha:</strong> {{ $schedule->date->format('Y-m-d') }}</p>
            <p><strong>Hora Inicio:</strong> {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</p>
            <p><strong>Hora Fin:</strong> {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</p>
            
            <div style="margin-top: 20px;">
                <a href="{{ route('admin.schedules.edit', $schedule->id) }}" style="color: blue;">Editar</a> |
                <a href="{{ route('admin.schedules.index') }}" style="color: #555;">Volver al listado</a>
            </div>
        </div>
    </div>
</x-admin-app-layout>
