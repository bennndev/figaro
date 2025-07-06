<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Reporte Pago #{{ $payment->id }}</title>
  <style> body { font-family: sans-serif; font-size:12px; } </style>
</head>
<body>
  <h1>Figaro Barbería</h1>
  <h2>Reporte de pago #{{ $payment->id }}</h2>
  <p><strong>Cliente:</strong> {{ $reservation->user->name }} {{ $reservation->user->last_name }}</p>
  <p><strong>Barbero:</strong> {{ $reservation->barber->name }} {{ $reservation->barber->last_name }}</p>
  <p><strong>Reserva:</strong> {{ $reservation->reservation_date->format('d/m/Y') }}
     a las {{ $reservation->reservation_time->format('H:i') }}</p>
  <p><strong>Monto:</strong> S/.{{ number_format($payment->amount/100, 2) }}</p>
  <p><strong>Estado del pago:</strong> {{ ucfirst($payment->status) }}</p>
  <hr>
  <h3>Servicios</h3>
  <ul>
    @foreach($reservation->services as $service)
      <li>{{ $service->name }} (x{{ $service->pivot->quantity ?? 1 }}) —
          S/.{{ number_format($service->price, 2) }}</li>
    @endforeach
  </ul>
</body>
</html>
