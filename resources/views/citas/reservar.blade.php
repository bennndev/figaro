@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Tarjeta para el formulario --}}
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Reservar Cita</h4>
                </div>

                <div class="card-body">
                    {{-- Formulario de reserva de cita --}}
                    <form method="POST" action="#">
                        @csrf

                        {{-- Nombre del cliente --}}
                        <div class="mb-3">
                            <label for="nombre_cliente" class="form-label">Tu nombre</label>
                            <input type="text" name="nombre_cliente" class="form-control" placeholder="Ingresa tu nombre" required>
                        </div>

                        {{-- Fecha de la reserva --}}
                        <div class="mb-3">
                            <label for="fecha_reserva" class="form-label">Fecha</label>
                            <input type="date" name="fecha_reserva" class="form-control" required>
                        </div>

                        {{-- Hora de la reserva --}}
                        <div class="mb-3">
                            <label for="hora_reserva" class="form-label">Hora</label>
                            <input type="time" name="hora_reserva" class="form-control" required>
                        </div>

                        {{-- Servicio (¿select dinámico después?) --}}
                        <div class="mb-3">
                            <label for="servicio" class="form-label">Servicio</label>
                            <input type="text" name="servicio" class="form-control" placeholder="Ej: Corte clásico" required>
                        </div>

                        {{-- Barbero (¿select dinámico después?) --}}
                        <div class="mb-3">
                            <label for="barbero" class="form-label">Barbero (opcional)</label>
                            <input type="text" name="barbero" class="form-control" placeholder="Si tienes uno favorito, pon su nombre">
                        </div>

                        {{-- Descripción de la cita (opcional) --}}
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción (opcional)</label>
                            <textarea name="descripcion" class="form-control" rows="3" placeholder="¿Algo que debamos saber?"></textarea>
                        </div>

                        {{-- Botón de reservar --}}
                        <button type="submit" class="btn btn-dark w-100">Reservar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
