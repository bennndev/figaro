{{-- resources/views/client/resources/payments/index.blade.php --}}

<x-app-layout>
  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Pagar Reserva</h1>

    @foreach($reservations as $reservation)
      <div class="border rounded p-4 mb-4">
        <h2 class="font-bold">Reserva #{{ $reservation->id }}
          <small class="text-sm text-gray-600">
            {{ $reservation->reservation_date->format('d/m/Y') }}
            {{ $reservation->reservation_time->format('H:i') }}
          </small>
        </h2>

        <ul class="mb-2">
          @foreach($reservation->services as $service)
            <li>
              {{ $service->name }} — 
              USD {{ number_format($service->price, 2) }}
              @if($service->pivot->quantity > 1)
                (x{{ $service->pivot->quantity }})
              @endif
            </li>
          @endforeach
        </ul>

        @php
          // calcular total: suma precio * cantidad
          $total = $reservation->services->sum(function($s){
              return $s->price * ($s->pivot->quantity ?? 1);
          });
        @endphp

        <form action="{{ route('client.payments.store') }}" method="POST" class="inline">
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
    @endforeach

    @if($reservations->isEmpty())
      <p>No tienes reservas pendientes de pago.</p>
    @endif
  </div>
</x-app-layout>
