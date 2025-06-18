@extends('layouts.app1') {{-- Usamos el Layout con Vite y Bootstrap --}}

@section('content')
<div class="container text-center">
    <h1 class="mb-4">Bienvenido a El Rincón del Barbero</h1>
    <p class="mb-5">Tu estilo comienza aquí. Reserva tu cita con nuestros mejores barberos.</p>

    <a href="/reservar" class="btn btn-custom">Reservar ahora</a>
</div>
@endsection
