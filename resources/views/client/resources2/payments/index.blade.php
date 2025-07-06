<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-2xl text-white leading-tight flex items-center space-x-2">
        <span>Pagos</span>
        <span class="mx-2 text-white">/</span>
        <a href="{{ route('dashboard') }}" class="text-[#FFFFFF]  flex items-center">
            
            <span>Inicio</span>
        </a>
    </h2>
</x-slot>
  <div class=" min-h-screen text-white py-12 px-6 md:px-12" x-data="{}">
    <div class="max-w-6xl mx-auto">

      {{-- Título Sección: Reservas pendientes --}}
<section class="mb-12">
  <div class="border-b border-gray-500 pb-2 mb-6 flex items-center gap-2">
    <h2 class="text-2xl font-semibold text-white">Reservas pendientes</h2>
  </div>

  @forelse($pending as $reservation)
    <div class="bg-[#1E1E1E] border border-gray-600 rounded-xl p-6 mb-6 shadow-lg hover:shadow-xl transition-all duration-300">

      <h3 class="text-lg font-bold text-white mb-2">
        Reserva #{{ $reservation->id }}
        <span class="text-sm text-white/60 ml-2">
          {{ $reservation->reservation_date->format('d/m/Y') }},
          {{ $reservation->reservation_time->format('H:i') }}
        </span>
      </h3>

      <ul class="list-disc pl-6 text-sm text-white/90 mb-4 space-y-1">
        @foreach($reservation->services as $service)
          <li>
            {{ $service->name }} —
            <span class="text-green-400 font-semibold">
              S/. {{ number_format($service->price, 2) }}
            </span>
            @if(($service->pivot->quantity ?? 1) > 1)
              <span class="text-white/70">(x{{ $service->pivot->quantity }})</span>
            @endif
          </li>
        @endforeach
      </ul>

      @php
        $total = $reservation->services->sum(fn($s) => $s->price * ($s->pivot->quantity ?? 1));
      @endphp

      <form action="{{ route('client.payments.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
        <button
          type="submit"
          class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow-md transition">
          💳 Pagar <span class="font-semibold">S/. {{ number_format($total, 2) }}</span>
        </button>
      </form>
    </div>
  @empty
    <p class="text-white/70">No tienes reservas pendientes de pago.</p>
  @endforelse
</section>

{{-- Título Sección: Historial de pagos --}}
<section>
  <div class="border-b border-gray-500 pb-2 mb-6">
    <h2 class="text-2xl font-semibold text-white">Historial de pagos</h2>
  </div>

  @forelse($paid as $reservation)
    <div class="bg-[#1E1E1E] border-l-4 border-green-500 rounded-xl p-6 mb-6 shadow-lg hover:shadow-xl transition">

      <h3 class="text-lg font-bold text-white mb-2">
        Reserva #{{ $reservation->id }}
        <span class="text-sm text-white/60 ml-2">
          Pagada el {{ $reservation->payment->updated_at->format('d/m/Y H:i') }}
        </span>
      </h3>

      <ul class="list-disc pl-6 text-sm text-white/90 mb-4 space-y-1">
        @foreach($reservation->services as $service)
          <li>
            {{ $service->name }} —
            <span class="text-green-400 font-semibold">
              S/. {{ number_format($service->price, 2) }}
            </span>
          </li>
        @endforeach
      </ul>

      @php
        $totalPaid = $reservation->payment->amount / 100;
      @endphp

      <p class="font-medium text-white mb-4">
        Total: <span class="text-green-400 font-semibold">S/. {{ number_format($totalPaid, 2) }}</span>
      </p>

      <div class="flex justify-end">
        <a href="{{ route('client.payments.report', $reservation->payment->id) }}" 
                           target="_blank"
                        class=" text-[#FFFFFF] hover:text-[#FFFFFF]/70 transition text-3xl" title="PDF Comprobante">
                            <i class="bi bi-filetype-pdf"></i>
                        </a>

      </div>
    </div>
  @empty
    <p class="text-white/70">Aún no tienes pagos completados.</p>
  @endforelse
</section>


    </div>
  </div>
  <x-client.perfil :user="Auth::user()" />

</x-app-layout>
