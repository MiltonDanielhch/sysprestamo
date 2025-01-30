@extends('adminlte::page')

@section('content_header')
<h1><b>Prestamos/Modificar Datos de un Prestamo </b></h1>
<hr>
@stop

@section('content')
<form action="{{ route('admin.prestamos.update', $prestamo->id) }}" method="post">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos del Cliente</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Busqueda del Cliente</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <select name="cliente_id" id="" class="form-control select2">
                                    <option value="">Buscar Cliente....</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ $prestamo->cliente_id == $cliente->id ? 'selected':'' }}>{{$cliente->nro_documento." - ". $cliente->apellidos. " ".$cliente->nombres }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary"><i class="fa fa-search"></i>Buscar Cliente</button>
                            </div>
                        </div>
                        @error('cliente_id')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="" id="contenido_cliente" style="display:block">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nro_documento">Documento</label>
                                    <input type="text" class="form-control" value="{{ $prestamo->cliente->nro_documento }}" name="nro_documento" id="nro_documento" disabled>
                                    @error('nro_documento')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombres">Nombre del Cliente</label>
                                    <input type="text" class="form-control" value="{{ $prestamo->cliente->nombres }}" name="nombres" id="nombres" disabled>
                                    @error('nombres')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="apellidos">Apellido del Cliente</label>
                                    <input type="text" class="form-control" value="{{ $prestamo->cliente->apellidos }}" name="apellidos" id="apellidos" disabled>
                                    @error('apellidos')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" value="{{ $prestamo->cliente->fecha_nacimiento }}"
                                        name="fecha_nacimiento" id="fecha_nacimiento" disabled>
                                    @error('fecha_nacimiento')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="genero">Genero</label>
                                    <input type="text" class="form-control" value="{{ $prestamo->cliente->genero }}"
                                    name="genero" id="genero" disabled>
                                    @error('genero')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="{{ $prestamo->cliente->email }}" name="email" id="email" disabled>
                                    @error('email')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input type="text" class="form-control" value="{{ $prestamo->cliente->celular }}" name="celular" id="celular" disabled>
                                    @error('celular')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ref_celular">Referencia Celular</label>
                                    <input type="text" class="form-control" value="{{ $prestamo->cliente->ref_celular }}" name="ref_celular" id="ref_celular" disabled>
                                    @error('ref_celular')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Datos del Prestamo</h3>
                </div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Monto del Prestamo</label>
                                    <input type="text" class="form-control" id="monto_prestado" name="monto_prestado" value="{{ $prestamo->monto_prestado }}">
                                    @error('monto_prestado')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="input-group mb-3">
                                    <label for="">Tasa de Interes</label>
                                    <input type="text" class="form-control" id="tasa_interes" name="tasa_interes" value="{{ $prestamo->tasa_interes }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('tasa_interes')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Modalidad</label>
                                    <select name="modalidad" id="modalidad" class="form-control">
                                        <option value="Diario" {{ $prestamo->modalidad == 'Diario' ? 'selected': '' }}>Diario</option>
                                        <option value="Semanal" {{ $prestamo->modalidad == 'Semanal' ? 'selected': '' }}>Semanal</option>
                                        <option value="Quincenal"{{ $prestamo->modalidad == 'Quincenal' ? 'selected': '' }}>Quincenal</option>
                                        <option value="Mensual" {{ $prestamo->modalidad == 'Mensual' ? 'selected': '' }}>Mensual</option>
                                        <option value="Anual">Anual</option>
                                    </select>
                                    @error('modalidad')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="">Nro de Cuotas</label>
                                    <input type="number" class="form-control" id="nro_cuotas" name="nro_cuotas" value="{{ $prestamo->nro_cuotas }}">
                                    @error('nro_cuotas')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Fecha de Prestamo</label>
                                    <input type="date" class="form-control" id="fecha_prestamo" name="fecha_inicio" value="{{ $prestamo->fecha_inicio }}">
                                    @error('fecha_inicio')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <!-- Botón para calcular el préstamo -->
                                    <div style="height: 33px"></div>
                                    <button type="button" class="btn btn-success" id="calcularPrestamo">
                                        <i class="fas fa-calculator"></i> Calcular Préstamo
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Monto Por Cuota</label>
                                    <input type="text" id="monto_cuota" class="form-control" disabled>
                                    <input type="text" id="monto_cuota2" name="monto_cuota" class="form-control" hidden>
                                    @error('monto_cuota')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Monto del Interes</label>
                                    <input type="text" id="monto_interes" name="monto_interes" class="form-control" disabled>
                                    @error('monto_interes')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Monto Final</label>
                                    <input type="text" id="monto_final" name="monto_final" class="form-control" disabled>
                                    <input type="text" id="monto_final2" name="monto_total" class="form-control" hidden>
                                    @error('monto_final')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Modificar Prestamo</button>

                </div>
            </div>
        </div>
    </div>
</form>
@stop

@section('css')
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }
</style>
@stop


@section('js')
<script>
    $(document).ready(function() {
    // Initialize Select2
    $('.select2').select2();

    // Fetch client data when a selection changes
    $('.select2').on('change', function() {
        var id = $(this).val();
        if (id) {
            $.ajax({
                url: "{{ url('/admin/prestamos/cliente/') }}" + '/' + id,
                type: 'GET',
                success: function(cliente) {
                    $('#contenido_cliente').css('display', 'block');
                    $('#nro_documento').val(cliente.nro_documento);
                    $('#nombres').val(cliente.nombres);
                    $('#apellidos').val(cliente.apellidos);
                    $('#fecha_nacimiento').val(cliente.fecha_nacimiento);
                    $('#genero').val(cliente.genero);
                    $('#email').val(cliente.email);
                    $('#celular').val(cliente.celular);
                    $('#ref_celular').val(cliente.ref_celular);
                },
                error: function() {
                    alert("No se puede obtener la información del cliente.");
                }
            });
        }
    });

    // Calculate loan when the button is clicked
    $('#calcularPrestamo').on('click', function() {
        calcularPrestamo();
    });

    // Define the loan calculation function
    function calcularPrestamo() {
        const montoPrestado = parseFloat($('#monto_prestado').val());
        const tasaInteres = parseFloat($('#tasa_interes').val()) / 100;
        const modalidad = $('#modalidad').val();
        const nroCuotas = parseInt($('#nro_cuotas').val());

        if (isNaN(montoPrestado) || isNaN(nroCuotas) || montoPrestado <= 0 || tasaInteres <= 0 || nroCuotas <= 0) {
            alert("Por favor ingrese un valor válido.");
            return;
        }

        let tasaInteresAjustada = 0;
        switch (modalidad) {
            case "Diario":
                tasaInteresAjustada = tasaInteres / 365;
                break;
            case "Semanal":
                tasaInteresAjustada = tasaInteres / 52;
                break;
            case "Quincenal":
                tasaInteresAjustada = tasaInteres / 24;
                break;
            case "Mensual":
                tasaInteresAjustada = tasaInteres;
                break;
            case "Anual":
                tasaInteresAjustada = tasaInteres * 12;
                break;
            default:
                alert("Modalidad no válida.");
                return;
        }

        const interesTotal = montoPrestado * tasaInteresAjustada * nroCuotas;
        const totalCancelar = montoPrestado + interesTotal;
        const cuota = totalCancelar / nroCuotas;

        $('#monto_cuota').val(cuota.toFixed(2));
        $('#monto_cuota2').val(cuota.toFixed(2));
        $('#monto_interes').val(interesTotal.toFixed(2));
        $('#monto_final').val(totalCancelar.toFixed(2));
        $('#monto_final2').val(totalCancelar.toFixed(2));
    }

    // Trigger loan calculation on page load
    calcularPrestamo();
});

</script>
@stop
