@extends('adminlte::page')

@section('content_header')
    <h1><b>Clientes/registro de un nuevo Cliente </b></h1>
    <hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingrese los Roles</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.clientes.update', $cliente->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nro_documento">Documento</label>
                                <input type="text" class="form-control" value="{{ old('nro_documento', $cliente->nro_documento) }}" name="nro_documento">
                                @error('nro_documento')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombres">Nombre del Cliente</label>
                                <input type="text" class="form-control" value="{{ old('nombres', $cliente->nombres) }}" name="nombres">
                                @error('nombres')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellidos">Apellido del Cliente</label>
                                <input type="text" class="form-control" value="{{ old('apellidos', $cliente->apellidos) }}" name="apellidos">
                                @error('apellidos')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}" name="fecha_nacimiento" required>
                                @error('fecha_nacimiento')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="genero">Genero</label>
                                <select name="genero" id="select_genero" class="form-control">
                                    <option value="MASCULINO" {{ old('genero', $cliente->genero) == 'MASCULINO' ? 'selected' : '' }}>MASCULINO</option>
                                    <option value="FEMENINO" {{ old('genero', $cliente->genero) == 'FEMENINO' ? 'selected' : '' }}>FEMENINO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="{{ old('email', $cliente->email) }}" name="email">
                                @error('email')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <input type="text" class="form-control" value="{{ old('celular', $cliente->celular) }}" name="celular">
                                @error('celular')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ref_celular">Referencia Celular</label>
                                <input type="text" class="form-control" value="{{ old('ref_celular', $cliente->ref_celular) }}" name="ref_celular">
                                @error('ref_celular')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Modificar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
