<x-barber-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Horario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Mensajes de error --}}
                @if ($errors->any())
                    <div style="color: red; margin-bottom: 15px;">
                        <ul style="list-style: disc; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('barber.schedules.update', $schedule->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Fecha --}}
                    <div style="margin-bottom: 15px;">
                        <label for="date" style="display: block; font-weight: bold;">Fecha</label>
                        <input type="date" name="date" id="date"
                            value="{{ old('date', $schedule->date) }}"
                            style="width: 100%; padding: 8px; border: 1px solid #ccc;">
                    </div>

                    {{-- Hora de Inicio --}}
                    <div style="margin-bottom: 15px;">
                        <label for="start_time" style="display: block; font-weight: bold;">Hora de Inicio</label>
                        <input type="time" name="start_time" id="start_time"
                            value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"
                            style="width: 100%; padding: 8px; border: 1px solid #ccc;">
                    </div>

                    {{-- Hora de Fin --}}
                    <div style="margin-bottom: 15px;">
                        <label for="end_time" style="display: block; font-weight: bold;">Hora de Fin</label>
                        <input type="time" name="end_time" id="end_time"
                            value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"
                            style="width: 100%; padding: 8px; border: 1px solid #ccc;">
                    </div>

                    {{-- Botones --}}
                    <div style="margin-top: 20px;">
                        <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                            Actualizar
                        </button>
                        <a href="{{ route('barber.schedules.index') }}" style="margin-left: 10px; color: #555;">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-barber-app-layout>
