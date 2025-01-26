@extends('adminlte::page')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-user-tag mr-2"></i><b>Registro de Nuevo Rol</b></h1>
    <hr class="bg-primary">
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-outline card-primary shadow">
                <div class="card-header bg-white">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle text-primary mr-2"></i>
                        Datos del Nuevo Rol
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.roles.store') }}" method="post" id="roleForm">
                        @csrf
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
                                       value="{{ old('name') }}"
                                       placeholder="Ej: Super Administrador"
                                       required
                                       autofocus
                                       maxlength="255"
                                       autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <span id="charCount">0/255</span>
                                    </span>
                                </div>
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                El nombre debe ser único y no contener espacios especiales
                            </small>
                        </div>

                        <div class="form-group mt-5">
                            <div class="d-grid gap-2">
                                <button type="submit"
                                        class="btn btn-primary btn-lg shadow-sm"
                                        id="submitBtn">
                                    <i class="fas fa-save mr-2"></i> Registrar Rol
                                </button>
                                <a href="{{ route('admin.roles.index') }}"
                                   class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-arrow-left mr-2"></i> Cancelar y Volver
                                </a>
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
        const form = document.getElementById('roleForm');
        const submitBtn = document.getElementById('submitBtn');

        // Contador de caracteres
        const updateCharCount = () => {
            const length = roleName.value.length;
            charCount.textContent = `${length}/255`;
            charCount.style.color = length > 200 ? '#dc3545' : '#6c757d';
        };

        // Validación en tiempo real
        roleName.addEventListener('input', (e) => {
            // Eliminar espacios en blanco
            e.target.value = e.target.value.replace(/\s+/g, ' ');
            updateCharCount();
        });

        // Manejar envío del formulario
        form.addEventListener('submit', () => {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status"></span>
                Registrando...
            `;
        });

        // Inicializar contador
        updateCharCount();

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
