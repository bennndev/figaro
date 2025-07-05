<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Barbero') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Barbero {{ $barber->name }} {{ $barber->last_name }}</h3>

                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>Email:</strong> {{ $barber->email }}</li>
                    <li><strong>Teléfono:</strong> {{ $barber->phone_number }}</li>
                    <li><strong>Descripción:</strong> {{ $barber->description }}</li>
                    <li><strong>Especialidades:</strong>
                        @if ($barber->specialties->isNotEmpty())
                            <ul class="list-inside list-disc ml-4 mt-1">
                                @foreach ($barber->specialties as $specialty)
                                    <li>{{ $specialty->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500">Sin especialidades registradas</span>
                        @endif
                    </li>
                    <li><strong>Creado:</strong> {{ $barber->created_at->format('d/m/Y H:i') }}</li>
                    <li><strong>Actualizado:</strong> {{ $barber->updated_at->format('d/m/Y H:i') }}</li>
                </ul>

                @if ($barber->profile_photo)
                    <div class="mt-6">
                        <img src="{{ asset('storage/' . $barber->profile_photo) }}" alt="Foto de perfil"
                            class="h-40 w-40 object-cover rounded-lg shadow">
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('admin.barbers.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
