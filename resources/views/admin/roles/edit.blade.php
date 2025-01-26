@extends('adminlte::page')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-user-edit mr-2"></i><b>Editar Rol</b></h1>
    <hr class="bg-primary">
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline card-primary shadow-lg">
                <div class="card-header bg-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-tag text-primary mr-2"></i>
                        Actualización de Rol
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.roles.update', $role) }}" method="POST" id="editRoleForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Nombre del Rol</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-user-shield"></i>
                                    </span>
                                </div>
                                <input type="text"
                                       class="form-control form-control-lg @error('name') is-invalid @enderror"
                                       name="name"
                                       id="roleName"
                                       value="{{ old('name', $role->name) }}"
                                       placeholder="Ej: Administrador"
                                       required
                                       autofocus
                                       maxlength="255"
                                       autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <span id="charCount">{{ strlen($role->name) }}/255</span>
                                    </span>
                                </div>
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                El nombre debe ser único y descriptivo
                            </small>
                        </div>

                        <div class="form-group mt-5">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.roles.index') }}"
                                   class="btn btn-outline-secondary"
                                   data-toggle="tooltip"
                                   title="Volver al listado de roles">
                                    <i class="fas fa-arrow-left mr-2"></i> Cancelar
                                </a>

                                <button type="submit"
                                        class="btn btn-primary btn-lg shadow-sm"
                                        id="submitBtn"
                                        data-toggle="tooltip"
                                        title="Guardar cambios">
                                    <i class="fas fa-save mr-2"></i> Actualizar Rol
                                </button>
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
<style>
    .card-header {
        border-bottom: 2px solid #007bff;
    }
    #roleName {
        border-radius: 0 0.25rem 0.25rem 0;
    }
    .input-group-text {
        transition: all 0.3s ease;
    }
    .input-group:focus-within .input-group-text {
        background-color: #0056b3;
    }
    #charCount {
        min-width: 70px;
        font-weight: 500;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const roleName = document.getElementById('roleName');
        const charCount = document.getElementById('charCount');
        const form = document.getElementById('editRoleForm');
        const submitBtn = document.getElementById('submitBtn');

        // Contador de caracteres
        const updateCharCount = () => {
            const length = roleName.value.length;
            charCount.textContent = `${length}/255`;
            charCount.style.color = length > 200 ? '#dc3545' : '#6c757d';
        };

        // Validación en tiempo real
        roleName.addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/\s+/g, ' ').trimStart();
            updateCharCount();
        });

        // Manejar envío del formulario
        form.addEventListener('submit', () => {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status"></span>
                Actualizando...
            `;
        });

        // Inicializar tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Mostrar notificación de éxito si existe
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    });
</script>
@stop
