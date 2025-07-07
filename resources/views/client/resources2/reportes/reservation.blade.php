<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Reporte Pago #{{ $payment->id }}</title>
  <style>
    body {
      font-family: sans-serif;
      font-size: 12px;
      color: #2a2a2a;
      margin: 30px;
    }

    .container {
      border: 1px solid #2a2a2a;
      border-radius: 8px;
      padding: 20px;
    }

    .header {
      text-align: center;
      background-color: #2a2a2a;
      color: #ffffff;
      padding: 10px 0;
      width: 100%;
      margin-bottom: 25px;
      border-radius: 6px 6px 0 0;
    }

    .header-content {
      max-width: 600px;
      margin: 0 auto;
    }

    .header-content img {
      max-width: 70px;
      max-height: 70px;
      margin-bottom: 6px;
    }

    .header-content h1 {
      font-size: 22px;
      margin: 0;
      color: #ffffff;
    }

    .header-content p {
      margin: 2px 0;
      font-size: 12px;
      color: #e0e0e0;
    }

    h2 {
      font-size: 16px;
      margin-top: 5px;
      margin-bottom: 12px;
    }

    h3 {
      font-size: 13px;
      margin-top: 20px;
      margin-bottom: 10px;
    }

    p {
      margin: 4px 0;
    }

    ul {
      padding-left: 20px;
    }

    li {
      margin-bottom: 4px;
    }

    hr {
      border: none;
      border-top: 1px solid #2a2a2a;
      margin: 20px 0;
    }
  </style>
</head>
<body>

  <div class="container">

    <!-- Encabezado a todo el ancho -->
    <div class="header">
      <div class="header-content">
        <img src="{{ public_path('images/image2.png') }}" alt="Ícono">
        <h1>Fígaro Barbería</h1>
        <p>Comprobante de pago</p>
      </div>
    </div>

    <h2>Reporte de pago #{{ $payment->id }}</h2>

    <p><strong>Cliente:</strong> {{ $reservation->user->name }} {{ $reservation->user->last_name }}</p>
    <p><strong>Barbero:</strong> {{ $reservation->barber->name }} {{ $reservation->barber->last_name }}</p>
    <p><strong>Reserva:</strong> {{ $reservation->reservation_date->format('d/m/Y') }} a las {{ $reservation->reservation_time->format('H:i') }}</p>
    <p><strong>Monto:</strong> S/.{{ number_format($payment->amount / 100, 2) }}</p>
    <p><strong>Estado del pago:</strong> {{ ucfirst($payment->status) }}</p>

    <hr>

    <h3>Servicios</h3>
    <ul>
      @foreach($reservation->services as $service)
        <li>{{ $service->name }} (x{{ $service->pivot->quantity ?? 1 }}) —
            S/.{{ number_format($service->price, 2) }}</li>
      @endforeach
    </ul>

  </div>

</body>
</html>
