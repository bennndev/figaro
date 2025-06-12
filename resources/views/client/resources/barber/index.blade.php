<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barberos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($barbers as $barber)
                <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                    <h3 class="text-xl font-bold">{{ $barber->name }} {{ $barber->last_name }}</h3>
                    <p class="text-gray-600 mt-2">{{ Str::limit($barber->description, 100) }}</p>
                    <a href="{{ route('client.barbers.show', $barber->id) }}"
                       class="text-indigo-600 hover:underline mt-4 inline-block">Ver más</a>
                </div>
            @empty
                <p>No hay barberos disponibles en este momento.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
