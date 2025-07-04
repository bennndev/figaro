<x-app-layout>
  <div class="bg-[#2A2A2A] min-h-screen text-white py-12 px-6 md:px-12" x-data="{}">
    <div class="max-w-6xl mx-auto">

      <h1 class="text-3xl font-bold mb-10 border-b border-white pb-4">Mis Pagos</h1>

      {{-- Sección: reservas pendientes --}}
      <section class="mb-12">
        <h2 class="text-2xl font-semibold mb-6 text-white">Reservas pendientes</h2>

        @forelse($pending as $reservation)
          <div class="bg-[#2A2A2A] border border-[#E5E4E2] rounded-xl p-6 mb-6 shadow-lg transition hover:border-white hover:shadow-xl">

            <h3 class="text-lg font-bold mb-2">
              Reserva #{{ $reservation->id }}
              <span class="text-sm text-gray-300 ml-2">
                {{ $reservation->reservation_date->format('d/m/Y') }},
                {{ $reservation->reservation_time->format('H:i') }}
              </span>
            </h3>

            <ul class="list-disc pl-6 text-sm text-white/90 mb-4">
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

            <form action="{{ route('client.payments.store') }}" method="POST" class="mt-4">
              @csrf
              <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
              <button
                type="submit"
                class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow-md transition">
                Pagar USD {{ number_format($total, 2) }}
              </button>
            </form>
          </div>
        @empty
          <p class="text-white/70">No tienes reservas pendientes de pago.</p>
        @endforelse
      </section>

      {{-- Sección: historial de pagos --}}
      <section>
        <h2 class="text-2xl font-semibold mb-6 text-white">Historial de pagos</h2>

        @forelse($paid as $reservation)
          <div class="bg-[#2A2A2A] border-l-4 border-green-500 rounded-xl p-6 mb-6 shadow-lg">

            <h3 class="text-lg font-bold mb-2">
              Reserva #{{ $reservation->id }}
              <span class="text-sm text-gray-300 ml-2">
                pagada el {{ $reservation->payment->updated_at->format('d/m/Y H:i') }}
              </span>
            </h3>

            <ul class="list-disc pl-6 text-sm text-white/90 mb-4">
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
                class="text-blue-400 hover:underline ml-4">
                Ver detalle
              </a>
            </p>
          </div>
        @empty
          <p class="text-white/70">Aún no tienes pagos completados.</p>
        @endforelse
      </section>
    </div>
  </div>
</x-app-layout>
