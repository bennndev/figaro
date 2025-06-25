{{-- resources/views/client/resources/payments/index.blade.php --}}

<x-app-layout>
  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Mis Pagos</h1>

    {{-- Sección: reservas pendientes de pago --}}
    <section class="mb-12">
      <h2 class="text-xl font-bold mb-4">Reservas pendientes</h2>

      @forelse($pending as $reservation)
        <div class="border rounded p-4 mb-4">
          <h3 class="font-semibold">
            Reserva #{{ $reservation->id }}
            <small class="text-sm text-gray-600">
              {{ $reservation->reservation_date->format('d/m/Y') }}
              {{ $reservation->reservation_time->format('H:i') }}
            </small>
          </h3>

          <ul class="mb-2 list-disc pl-5">
            @foreach($reservation->services as $service)
              <li>
                {{ $service->name }} —
                USD {{ number_format($service->price, 2) }}
                @if(($service->pivot->quantity ?? 1) > 1)
                  (x{{ $service->pivot->quantity }})
                @endif
              </li>
            @endforeach
          </ul>

          @php
            $total = $reservation->services
              ->sum(fn($s) => $s->price * ($s->pivot->quantity ?? 1));
          @endphp

          <form action="{{ route('client.payments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
            <button
              type="submit"
              class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
              Pagar USD {{ number_format($total, 2) }}
            </button>
          </form>
        </div>
      @empty
        <p>No tienes reservas pendientes de pago.</p>
      @endforelse
    </section>

    {{-- Sección: historial de pagos completados --}}
    <section>
      <h2 class="text-xl font-bold mb-4">Historial de pagos</h2>

      @forelse($paid as $reservation)
        <div class="border-l-4 border-green-500 bg-green-50 p-4 mb-4">
          <h3 class="font-semibold">
            Reserva #{{ $reservation->id }}
            <small class="text-sm text-gray-600">
              pagada el {{ $reservation->payment->updated_at->format('d/m/Y H:i') }}
            </small>
          </h3>

          <ul class="mb-2 list-disc pl-5">
            @foreach($reservation->services as $service)
              <li>
                {{ $service->name }} —
                USD {{ number_format($service->price, 2) }}
              </li>
            @endforeach
          </ul>

          @php
            $totalPaid = $reservation->payment->amount / 100;
          @endphp
          <p class="font-medium">
            Total: USD {{ number_format($totalPaid, 2) }}
            <a
              href="{{ route('client.payments.show', $reservation->payment->id) }}"
              class="text-blue-600 hover:underline ml-4"
            >
              Ver detalle
            </a>
          </p>
        </div>
      @empty
        <p>Aún no tienes pagos completados.</p>
      @endforelse
    </section>
  </div>
</x-app-layout>
