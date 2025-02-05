@extends('adminlte::page')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-user-tag mr-2"></i><b>Roles/Asignar Permisos al {{ $rol->name }}</b></h1>
    <hr class="bg-primary">
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card card-outline card-primary shadow">
                <div class="card-header bg-white">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle text-primary mr-2"></i>
                        Datos del Nuevo Permisos
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/roles/asignar',$rol->id) }}" method="post" >
                        @csrf
                        @method('put')
                        <div class="row">
                            @foreach($permisos as $modulo => $grupoPermisos)
                                <div class="col-md-4 mb-4">
                                    <h4 class="text-primary">{{ ucfirst($modulo) }}</h4>
                                    <div class="border rounded p-3 shadow-sm">
                                        @foreach($grupoPermisos as $permiso)
                                            <div class="form-check mb-2">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="permiso_{{ $permiso->id }}"
                                                    name="permisos[]"
                                                    value="{{ $permiso->id }}"
                                                        {{ $rol->hasPermissionTo($permiso->name) ? 'checked' : '' }}
                                                >
                                                <label class="form-check-label" for="permiso_{{ $permiso->id }}">
                                                    {{ $permiso->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
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
