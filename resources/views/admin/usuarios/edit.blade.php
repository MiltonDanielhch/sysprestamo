@extends('adminlte::page')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-user-edit mr-2"></i><b>Editar Usuario</b></h1>
    <hr class="bg-primary">
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-outline card-primary shadow-lg">
                <div class="card-header bg-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-cog text-primary mr-2"></i>
                        Actualización de Datos
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST" id="editUserForm">
                        @csrf
                        @method('PUT')

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
                                               value="{{ old('name', $usuario->name) }}"
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
                                               value="{{ old('email', $usuario->email) }}"
                                               required>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
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
                                                {{ $usuario->hasRole($role->name) ? 'selected' : '' }}>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Nueva Contraseña</label>
                                    <div class="input-group">
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               id="newPassword"
                                               placeholder="Dejar vacío para no cambiar">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Mínimo 8 caracteres, incluir mayúsculas, números y símbolos</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                    <input type="password"
                                           class="form-control"
                                           name="password_confirmation"
                                           placeholder="Repetir nueva contraseña">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group d-flex justify-content-between">
                                    <a href="{{ route('admin.usuarios.index') }}"
                                       class="btn btn-outline-secondary"
                                       data-toggle="tooltip"
                                       title="Volver al listado">
                                        <i class="fas fa-arrow-left mr-2"></i> Cancelar
                                    </a>
                                    <button type="submit"
                                            class="btn btn-primary"
                                            data-toggle="tooltip"
                                            title="Guardar cambios">
                                        <i class="fas fa-save mr-2"></i> Actualizar
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

</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar Select2
        $('#roles').select2({
            placeholder: "Seleccione roles",
            allowClear: true
        });

        // Toggle para mostrar contraseña
        $('#togglePassword').click(function() {
            const passwordField = $('#password');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });

        // Validación de contraseña
        $('#editUserForm').submit(function(e) {
            const password = $('#password').val();
            if(password.length > 0 && password.length < 8) {
                e.preventDefault();
                Swal.fire('Error', 'La contraseña debe tener al menos 8 caracteres', 'error');
            }
        });

    });
</script>
@stop
