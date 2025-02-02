@extends('adminlte::page')

@section('content_header')
<h1><b>Prestamos/registro de un nuevo Pago </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
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
                                    <option value="{{ $cliente->id }}"{{ $datosCliente->id == $cliente->id ? 'selected':'' }} >{{$cliente->nro_documento." - ". $cliente->apellidos. " ".$cliente->nombres }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary"><i class="fa fa-search"></i>Buscar Cliente</button>
                        </div>
                    </div>
                    @error('cliente_id')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos del Cliente</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <b>Nro Documento</b> <br>
                            <i class="fas fa-id-card"></i>{{ $datosCliente->nro_documento }} <br> <br>
                            <b>Nombre y Apellido</b> <br>
                            <i class="fas fa-user"></i>{{ $datosCliente->apellido." ".$datosCliente->nombres }} <br> <br>
                            <b>Fecha de Nacimiento</b> <br>
                            <i class="fas fa-calendar"></i>{{ $datosCliente->fecha_nacimiento  }} <br> <br>
                            <b>Genero</b> <br>
                            <i class="fas fa-user-check"></i>{{ $datosCliente->genero }} <br> <br>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <b>Email</b> <br>
                        <i class="fas fa-envelope"></i>{{ $datosCliente->email }} <br> <br>
                        <b>Celular</b> <br>
                        <i class="fas fa-envelope"></i>{{ $datosCliente->celular }} <br> <br>
                        <b>Referencia de Celular</b> <br>
                        <i class="fas fa-envelope"></i>{{ $datosCliente->ref_celular }} <br> <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Datos del Prestamo</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <b>Monto Prestamo</b> <br>
                        <i class="fas fa-money-bill-wave"></i>{{ $prestamo->monto_prestado }} <br> <br>
                        <b>Tasa de Interes</b> <br>
                        <i class="fas fa-percentage"></i>{{ $prestamo->tasa_interes }} <br> <br>
                        <b>Modalidad</b> <br>
                        <i class="fas fa-calendar-alt"></i>{{ $prestamo->modalidad }} <br> <br>
                        <b>Nro de Cuotas</b> <br>
                        <i class="fas fa-list"></i>{{ $prestamo->nro_cuotas }} <br> <br>
                        <b>Monto Total</b> <br>
                        <i class="fas fa-money-bill-alt"></i>{{ $prestamo->monto_total }} <br> <br>

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
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
    $(document).ready(function(){
        $('.select2').select2();

        $('.select2').on('change', function(){
            var id = $(this).val();
            if(id){
                window.location.href = "{{ url('/admin/pagos/create/') }}"+"/"+id;
            }
        });

           // Asignar el evento de click al botón
        $('#calcularPrestamo').on('click', function() {
            calcularPrestamo();
        });

        // Definir la función calcularPrestamo
        function calcularPrestamo() {
            const montoPrestado = parseFloat(document.getElementById('monto_prestado').value);
            const tasaInteres = parseFloat(document.getElementById('tasa_interes').value) / 100;
            const modalidad = document.getElementById('modalidad').value;
            const nroCuotas = parseInt(document.getElementById('nro_cuotas').value);
            const fechaPrestamo = document.getElementById('fecha_prestamo').value;

            if (isNaN(montoPrestado) || isNaN(nroCuotas) || montoPrestado <= 0 || tasaInteres <= 0 || nroCuotas <= 0) {
                alert("Por favor ingrese un valor válido");
                return;
            }

            // Ajusta la tasa de interés según la modalidad
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
                    alert("Modalidad no válida");
                    return;
            }

            // Calcular el interés total
            const interesTotal = montoPrestado * tasaInteresAjustada * nroCuotas;

            // Cálculo del total a pagar
            const totalCancelar = montoPrestado + interesTotal;

            // Cálculo de la cuota fija
            const cuota = totalCancelar / nroCuotas;

            $('#monto_cuota').val(cuota.toFixed(2));
            $('#monto_cuota2').val(cuota.toFixed(2));
            $('#monto_interes').val(interesTotal.toFixed(2));
            $('#monto_final').val(totalCancelar.toFixed(2));
            $('#monto_final2').val(totalCancelar.toFixed(2));

            // Mostrar los resultados
            // alert(`Resultado del Préstamo:
            //         Monto Prestado: $${montoPrestamo.toFixed(2)}
            //         Modalidad: ${modalidad}
            //         Número de Cuotas: ${nroCuotas}
            //         Interés Total: $${interesTotal.toFixed(2)}
            //         Cuota Por Pagar: $${cuota.toFixed(2)}
            //         Total a Cancelar: $${totalCancelar.toFixed(2)}
            // `);
        }
    });
</script>
@stop
