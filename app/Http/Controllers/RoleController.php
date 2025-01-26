<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Traits\ApiResponses;
class RoleController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);
        Role::create([
            'name' => $validated['name'],
            'guard_name' => 'web', // Aquí se agrega el valor de guard_name
        ]);

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'El rol se ha creado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($role->id)
            ]
        ]);

        $role->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('admin.roles.index')
            ->with( [
                'icono' => 'success',
                'mensaje' => 'Rol actualizado exitosamente'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        Role::destroy($id);

        return redirect()->route('admin.configuracion.index')
        ->with('mensaje', 'Error al eliminar la configuración.')
        ->with('icono', 'success');
    }
}
