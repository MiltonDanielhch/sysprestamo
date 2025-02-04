<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestamos = Prestamo::all();

        foreach ($prestamos as $prestamo){
            $prestamo->tiene_cuota_pagada = Pago::WhereNotnull('fecha_cancelado')
                ->where('prestamo_id', $prestamo->id)
                ->exists();
        }

        return view('admin.prestamos.index', compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('admin.prestamos.create', compact('clientes'));
    }

    public function obtenerCliente($id){
        $cliente = Cliente::find($id);
        if($cliente){
            return response()->json($cliente);
        }
        return response()->json($cliente);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'cliente_id' => 'required',
            'monto_prestado' => 'required',
            'tasa_interes' => 'required',
            'modalidad' => 'required',
            'nro_cuotas' => 'required',
            'fecha_inicio' => 'required',
            'monto_total' => 'required',
            'monto_cuota' => 'required',
        ]);

        // dd($validated);

        $prestamo = new Prestamo();
        $prestamo->cliente_id = $request->cliente_id;
        $prestamo->monto_prestado = $request->monto_prestado;
        $prestamo->tasa_interes = $request->tasa_interes;
        $prestamo->modalidad = $request->modalidad;
        $prestamo->nro_cuotas = $request->nro_cuotas;
        $prestamo->fecha_inicio = $request->fecha_inicio;
        $prestamo->monto_total = $request->monto_total;
        $prestamo->save();

        for($i = 1; $i <= $request->nro_cuotas; $i++){
            $pago = new Pago();
            $pago->prestamo_id = $prestamo->id;
            $pago->monto_pagado = $request->monto_cuota;

            // dd($pago);
            $fechaInicio = Carbon::parse($request->fecha_inicio);
            switch($request->modalidad){
                case 'Diario':
                    $fechaVencimiento = $fechaInicio->copy()->addDays($i);
                    break;
                case 'Semanal':
                    $fechaVencimiento = $fechaInicio->copy()->addWeeks($i);
                    break;
                case 'Quincenal':
                    $fechaVencimiento = $fechaInicio->copy()->addWeeks($i * 2  - 1);
                    break;
                case 'Mensual':
                    $fechaVencimiento = $fechaInicio->copy()->addMonths($i);
                    break;
                case 'Anual':
                    $fechaVencimiento = $fechaInicio->copy()->addYears($i);
                    break;
            }
            $pago->fecha_pago = $fechaVencimiento;
            $pago->metodo_pago = 'Efectivo';
            $pago->referencia_pago = 'Pago de la cuota '.$i;
            $pago->estado = 'Pendiente';
            $pago->save();
        }

        return redirect()->route('admin.prestamos.index')
            ->with('mensaje' , 'se registro de manera exitosa')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prestamo = Prestamo::find($id);
        $pagos = Pago::where('prestamo_id', $prestamo->id)->get();
        return view('admin.prestamos.show', compact('prestamo', 'pagos'));
    }


    public function contratos($id)
    {
        // Obtener configuración
        $configuracion = Configuracion::first();

        // Obtener préstamo con relaciones
        $prestamo = Prestamo::with('cliente')->findOrFail($id);

        // Autorización
        // Gate::authorize('view', $prestamo);

        // Obtener pagos ordenados
        $pagos = Pago::where('prestamo_id', $prestamo->id)
                    ->orderBy('fecha_pago')
                    ->get();

        // Generar PDF
        $pdf = Pdf::loadView('admin.prestamos.contratos', compact('prestamo', 'pagos', 'configuracion'));

        return $pdf->stream('contrato-prestamo-' . $prestamo->id . '.pdf');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prestamo = Prestamo::find($id);
        $clientes = Cliente::all();
        return view('admin.prestamos.edit', compact('prestamo', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd(request()->all());
        $validated = $request->validate([
            'cliente_id' => 'required',
            'monto_prestado' => 'required',
            'tasa_interes' => 'required',
            'modalidad' => 'required',
            'nro_cuotas' => 'required',
            'fecha_inicio' => 'required',
            'monto_total' => 'required',
            'monto_cuota' => 'required',
        ]);

        // dd($validated);

        $prestamo = Prestamo::find($id);
        $prestamo->cliente_id = $request->cliente_id;
        $prestamo->monto_prestado = $request->monto_prestado;
        $prestamo->tasa_interes = $request->tasa_interes;
        $prestamo->modalidad = $request->modalidad;
        $prestamo->nro_cuotas = $request->nro_cuotas;
        $prestamo->fecha_inicio = $request->fecha_inicio;
        $prestamo->monto_total = $request->monto_total;
        $prestamo->save();

        Pago::where('prestamo_id',$id)->delete();

        for($i = 1; $i <= $request->nro_cuotas; $i++){
            $pago = new Pago();
            $pago->prestamo_id = $prestamo->id;
            $pago->monto_pagado = $request->monto_cuota;

            // dd($pago);
            $fechaInicio = Carbon::parse($request->fecha_inicio);
            switch($request->modalidad){
                case 'Diario':
                    $fechaVencimiento = $fechaInicio->copy()->addDays($i);
                    break;
                case 'Semanal':
                    $fechaVencimiento = $fechaInicio->copy()->addWeeks($i);
                    break;
                case 'Quincenal':
                    $fechaVencimiento = $fechaInicio->copy()->addWeeks($i * 2  - 1);
                    break;
                case 'Mensual':
                    $fechaVencimiento = $fechaInicio->copy()->addMonths($i);
                    break;
                case 'Anual':
                    $fechaVencimiento = $fechaInicio->copy()->addYears($i);
                    break;
            }
            $pago->fecha_pago = $fechaVencimiento;
            $pago->metodo_pago = 'Efectivo';
            $pago->referencia_pago = 'Pago de la cuota '.$i;
            $pago->estado = 'Pendiente';
            $pago->save();
        }
        return redirect()->route('admin.prestamos.index')
            ->with('mensaje', 'se modifico el prestamo de manera exitosa')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Prestamo::destroy($id);
        return redirect()->route('admin.prestamos.index')
        ->with('mensaje', 'se elimino el prestamo de manera exitosa')
        ->with('icono', 'success');
    }
}
