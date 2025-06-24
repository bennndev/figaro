<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">{{ __('Pagar Reserva') }}</h2>
  </x-slot>

  <div class="container mx-auto p-6">
    <form action="{{ route('client.payments.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label for="service_id" class="block mb-1">Servicio</label>
        <select name="service_id" id="service_id" class="border rounded px-3 py-2 w-full">
          @foreach($services as $srv)
            <option value="{{ $srv->id }}">
              {{ $srv->name }} — USD {{ number_format($srv->price, 2) }}
            </option>
          @endforeach
        </select>
        @error('service_id')
          <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <button
        type="submit"
        class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700"
      >
        Ir a Stripe Checkout
      </button>
    </form>
  </div>
</x-app-layout>
