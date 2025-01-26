@extends('adminlte::page')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-user-plus mr-2"></i><b>Registro de Nuevo Usuario</b></h1>
    <hr class="bg-primary">
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-outline card-primary shadow-lg">
                <div class="card-header bg-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-circle text-primary mr-2"></i>
                        Datos del Usuario
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.usuarios.store') }}" method="post" id="userForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre Completo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="name"
                                               value="{{ old('name') }}"
                                               placeholder="Ej: Juan Pérez"
                                               required>
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ old('email') }}"
                                               placeholder="Ej: juan@example.com"
                                               required>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               id="password"
                                               placeholder="Mínimo 8 caracteres"
                                               required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                        <input type="password"
                                               class="form-control"
                                               name="password_confirmation"
                                               placeholder="Repite la contraseña"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="roles">Roles</label>
                                    <select name="roles[]" id="roles"
                                            class="form-control select2 @error('roles') is-invalid @enderror"
                                            multiple="multiple"
                                            required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group d-flex justify-content-between">
                                    <a href="{{ route('admin.usuarios.index') }}"
                                       class="btn btn-outline-secondary"
                                       data-toggle="tooltip"
                                       title="Volver al listado de usuarios">
                                        <i class="fas fa-arrow-left mr-2"></i> Cancelar
                                    </a>
                                    <button type="submit"
                                            class="btn btn-primary"
                                            data-toggle="tooltip"
                                            title="Guardar nuevo usuario">
                                        <i class="fas fa-save mr-2"></i> Registrar Usuario
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
    .select2-selection--multiple {
        min-height: 38px;
        padding: 5px;
    }
    .password-strength {
        height: 5px;
        margin-top: 5px;
        display: none;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar Select2
        $('#roles').select2({
            placeholder: "Seleccione uno o más roles",
            allowClear: true
        });

        // Toggle para mostrar contraseña
        $('#togglePassword').click(function() {
            const passwordField = $('#password');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });

        // Validación de contraseña en tiempo real
        $('#password').on('input', function() {
            // Implementar lógica de fortaleza de contraseña
        });

        // Inicializar tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Prevenir doble envío
        $('#userForm').submit(function() {
            $(this).find('button[type="submit"]').prop('disabled', true);
        });
    });
</script>
@stop
