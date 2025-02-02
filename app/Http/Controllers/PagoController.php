<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Prestamo;
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

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
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
    public function update(Request $request, $id)
    {
        $pago = Pago::find($id);

        // Actualiza los detalles del pago
        $pago->estado = "Confirmado"; // Ejemplo de actualización
        $pago->fecha_cancelado = now(); // Actualiza la fecha de cancelación
        $pago->save();

        // Redirige de vuelta con un mensaje de éxito
        return redirect()->back()->with('mensaje', 'Pago confirmado')->with('icono', 'success');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
