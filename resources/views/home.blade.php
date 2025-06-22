@extends('layouts.app1')

@section('content')
<div class="text-center text-white">
    <h1 class="display-4 fw-bold mb-4">Bienvenido a <span class="text-light">Fígaro</span></h1>
    <p class="lead mb-5">Tu estilo comienza aquí. Regístrate o inicia sesión para reservar tu cita con nuestros mejores barberos.</p>

    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="/login" class="btn btn-outline-light px-4 py-2">
            <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
        </a>
        <a href="/register" class="btn btn-outline-light px-4 py-2">
            <i class="bi bi-pencil-square"></i> Registrarse
        </a>
    </div>
</div>
@endsection
