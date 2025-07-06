{{-- resources/views/client/resources/payments/show.blade.php --}}
<x-app-layout>
  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Detalle de Pago #{{ $payment->id }}</h1>

    <p><strong>Reserva:</strong> #{{ $payment->reservation->id }}</p>
    <p><strong>Fecha pago:</strong> {{ $payment->updated_at->format('d/m/Y H:i') }}</p>
    <p><strong>Monto:</strong> S/. {{ number_format($payment->amount/100,2) }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($payment->status) }}</p>

    <h2 class="text-xl font-semibold mt-6">Servicios</h2>
    <ul class="list-disc pl-6">
      @foreach($payment->reservation->services as $service)
        <li>{{ $service->name }}
            — S/. {{ number_format($service->price,2) }}
            @if($service->pivot->quantity>1)(x{{ $service->pivot->quantity }})@endif
        </li>
      @endforeach
    </ul>
  </div>
</x-app-layout>
