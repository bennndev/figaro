<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Especialidad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Especialidad {{ $specialty->name }}</h3>

                <ul class="list-disc pl-5">
                    <li><strong>Creado:</strong> {{ $specialty->created_at->format('d/m/Y H:i') }}</li>
                    <li><strong>Actualizado:</strong> {{ $specialty->updated_at->format('d/m/Y H:i') }}</li>
                </ul>

                <div class="mt-6">
                    <a href="{{ route('admin.specialties.index') }}" class="text-blue-600 hover:underline">← Volver al listado</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
