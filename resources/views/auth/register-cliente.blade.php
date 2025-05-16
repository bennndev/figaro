@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{--Tarjeta para el formulario--}}
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Registro de Cliente</h4>
                </div>

                <div class="card-body">
                    {{--Formulario de registro de cliente--}}
                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf {{--Protección CSRF(Token oculto en formularios) de Laravel--}}

                        {{--Nombre del cliente--}}
                        <div class="mb-3">
                            <label for="nombre_cliente" class="form-label">Nombre</label>
                            <input type="text" name="nombre_cliente" class="form-control" placeholder="Ingresa tu nombre" required>
                        </div>

                        {{--Apellido del cliente--}}
                        <div class="mb-3">
                            <label for="apellido_cliente" class="form-label">Apellido</label>
                            <input type="text" name="apellido_cliente" class="form-control" placeholder="Ingresa tu apellido" required>
                        </div>

                        {{--Email del cliente--}}
                        <div class="mb-3">
                            <label for="email_cliente" class="form-label">Correo electrónico</label>
                            <input type="email" name="email_cliente" class="form-control" placeholder="ejemplo@correo.com" required>
                        </div>

                        {{--Celular del cliente--}}
                        <div class="mb-3">
                            <label for="celular_cliente" class="form-label">Celular</label>
                            <input type="tel" name="celular_cliente" class="form-control" placeholder="123456789" required>
                        </div>

                        {{--Contraseña--}}
                        <div class="mb-3">
                            <label for="contraseña_cliente" class="form-label">Contraseña</label>
                            <input type="password" name="contraseña_cliente" class="form-control" required>
                        </div>

                        {{--Foto del cliente--}}
                        <div class="mb-3">
                            <label for="foto_cliente" class="form-label">Foto de perfil (opcional)</label>
                            <input type="file" name="foto_cliente" class="form-control">
                        </div>

                        {{--Botón de registro--}}
                        <button type="submit" class="btn btn-dark w-100">Registrar Cliente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection