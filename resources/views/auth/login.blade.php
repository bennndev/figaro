@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Tarjeta para el formulario de login --}}
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Iniciar Sesión</h4>
                </div>

                <div class="card-body">
                    {{-- Formulario de login --}}
                    <form method="POST" action="#">
                        @csrf {{-- Token CSRF de seguridad (aunque no funcional aún) --}}

                        {{-- Email del usuario --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="ejemplo@correo.com" required>
                        </div>

                        {{-- Contraseña --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        {{-- Recordarme --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Recordarme</label>
                        </div>

                        {{-- Botón para iniciar sesión --}}
                        <button type="submit" class="btn btn-dark w-100">Ingresar</button>
                    </form>

                    {{-- Enlaces adicionales --}}
                    <div class="mt-3 text-center">
                        <a href="#">¿Olvidaste tu contraseña?</a><br>
                        <a href="/registro-cliente">¿No tienes cuenta? Regístrate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
