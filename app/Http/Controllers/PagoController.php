<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Prestamo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        $pagos = Pago::all();
        // $pagos = Pago::whereNotNull('fecha_cancelado');
        return view('admin.pagos.index', compact('pagos', 'clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cargarPrestamosCliente($id){
        $cliente = Cliente::find($id);
        $prestamos = Prestamo::where('cliente_id', $cliente->id)->get();
        return view('admin.pagos.cargar_prestamos_cliente', compact('cliente', 'prestamos'));
    }

    public function create($id)
    {
        $prestamo = Prestamo::find($id);
        $pagos = Pago::where('prestamo_id', $id)->get();
        return view('admin.pagos.create', compact('prestamo', 'pagos'));
    }


    // public function obtenerCliente($id){
    //     $cliente = Cliente::find($id);
    //     if($cliente){
    //         return response()->json($cliente);
    //     }
    //     return response()->json($cliente);
    // }

    public function cargarDatos($id){
        // echo $id;
        $datosCliente = Cliente::find($id);
        $clientes = Cliente::all();

        $prestamo = Prestamo::where('cliente_id');
        // $pagos = Pago::where('prestamo_id',$prestamo->id)->get();
        return view('admin.pagos.cargar_datos', compact('clientes', 'datosCliente'));
    }
    /**
     * Store a newly created resource in storage.
     */


    public function store($id)
    {
        // $pago = Pago::find($id);
        // $pago->estado = "Confirmado";
        // $pago->fecha_cancelado = date('Y-m-d');
        // $pago->save();

        // return redirect()->back()
        //     ->with('mensaje', 'se registro')
        //     ->with('icono', 'success');
    }

    public function comprobantedepago($id){
        // $pago = Pago::find($id);
        $pago = Pago::with('cliente')->findOrFail($id);
        $prestamo = Prestamo::where('id', $pago->prestamo_id)->first();
        $cliente = Cliente::where('id', $prestamo->cliente_id)->first();
        // dd($pago);
        $configuracion = Configuracion::latest()->first();
        $pdf = Pdf::loadView('admin.pagos.comprobantedepago', compact('pago', 'configuracion', 'pago', 'prestamo', 'cliente'));

        return $pdf->stream();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pago = Pago::find($id);
        $prestamo = Prestamo::where('id', $pago->prestamo_id)->first();
        $cliente = Cliente::where('id', $prestamo->cliente_id)->first();

        return view('admin.pagos.show', compact('pago', 'prestamo', 'cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $pago = Pago::findOrFail($id);

        // Actualizar los campos
        $pago->estado = "Confirmado";
        $pago->fecha_cancelado = now(); // Fecha y hora actual

        $pago->save();

        $total_cuotas_faltantes = Pago::where('prestamo_id', $pago->prestamo->id)
        ->where('estado', 'Pendiente')
        ->count();

        if ($total_cuotas_faltantes == 0) {
            // echo "Todas las cuotas han sido pagadas.";
            $prestamo = Prestamo::find($pago->prestamo_id);
            $prestamo->estado = 'Cancelado';
            $prestamo->save();
        }
        else {
            echo "Todavía hay cuotas pendientes.";
        }

        // return redirect()->back()
        //     ->with('mensaje', 'Pago confirmado exitosamente')
        //     ->with('icono', 'success');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pago = Pago::find($id);
        $pago->fecha_cancelado = null ;
        $pago->estado = "Pendiente";
        $pago->save();

        return redirect()->route('admin.pagos.index')
        ->with('mensaje', 'Pago cancelado exitosamente')
        ->with('icono', 'success');
    }
}
