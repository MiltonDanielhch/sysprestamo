<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $configuraciones = Configuracion::all();  // Paginación de 10 por página

        return view('admin.configuraciones.index', compact('configuraciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.configuraciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'logo' => 'required',
        ]);
        $configuracion = new Configuracion();
        $configuracion->nombre = $request->nombre;
        $configuracion->descripcion = $request->descripcion;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->email = $request->email;
        $configuracion->web = $request->web;
        $configuracion->moneda = $request->moneda;
        $configuracion->logo = $request->file('logo')->store('logos', 'public');
        $configuracion->save();

        return redirect()->route('admin.configuracion.index')
            ->with('mensaje', 'se registro la configuración correctamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $configuracion = Configuracion::find($id);
        return view('admin.configuraciones.show', compact('configuracion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $configuracion = Configuracion::find($id);
        return view('admin.configuraciones.edit', compact('configuracion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los campos
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validar tipo y tamaño del archivo
        ]);

        // Buscar la configuración a actualizar
        $configuracion = Configuracion::find($id);

        // Verificar si la configuración existe
        if (!$configuracion) {
            return redirect()->route('admin.configuracion.index')
                ->with('mensaje', 'Configuración no encontrada.')
                ->with('icono', 'error');
        }

        // Actualizar los campos de la configuración
        $configuracion->nombre = $request->nombre;
        $configuracion->descripcion = $request->descripcion;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->email = $request->email;
        $configuracion->web = $request->web;
        $configuracion->moneda = $request->moneda;

        // Manejar la carga del logo
        if ($request->hasFile('logo')) {
            // Eliminar el logo anterior si existe
            if ($configuracion->logo) {
                $oldLogoPath = $configuracion->logo; // Usar la ruta relativa almacenada en la base de datos

                if (Storage::disk('public')->exists($oldLogoPath)) {
                    Storage::disk('public')->delete($oldLogoPath);
                    Log::info("Logo anterior eliminado: " . $oldLogoPath);
                } else {
                    Log::warning("El logo anterior no se encontró en la ruta: " . $oldLogoPath);
                }
            }

            // Subir y guardar el nuevo logo
            try {
                $logoPath = $request->file('logo')->store('logos', 'public');
                $configuracion->logo = $logoPath;
                Log::info("Nuevo logo guardado en: " . $logoPath);
            } catch (\Exception $e) {
                Log::error("Error al subir el logo: " . $e->getMessage());
                return redirect()->route('admin.configuracion.index')
                    ->with('mensaje', 'Error al subir el logo.')
                    ->with('icono', 'error');
            }
        }

        // Guardar los cambios en la base de datos
        $configuracion->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.configuracion.index')
            ->with('mensaje', 'La configuración se actualizó correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            // Buscar la configuración a eliminar
            $configuracion = Configuracion::find($id);

            // Verificar si la configuración existe
            if (!$configuracion) {
                return redirect()->route('admin.configuracion.index')
                    ->with('mensaje', 'Configuración no encontrada.')
                    ->with('icono', 'error');
            }

            // Eliminar el logo asociado si existe
            if ($configuracion->logo && Storage::disk('public')->exists($configuracion->logo)) {
                Storage::disk('public')->delete($configuracion->logo);
                Log::info("Logo eliminado: " . $configuracion->logo);
            } else {
                Log::warning("El logo no se encontró en la ruta: " . $configuracion->logo);
            }

            // Eliminar la configuración de la base de datos
            $configuracion->delete();

            DB::commit();

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.configuracion.index')
                ->with('mensaje', 'La configuración se eliminó correctamente.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al eliminar la configuración: " . $e->getMessage());

            return redirect()->route('admin.configuracion.index')
                ->with('mensaje', 'Error al eliminar la configuración.')
                ->with('icono', 'error');
        }
    }
}
