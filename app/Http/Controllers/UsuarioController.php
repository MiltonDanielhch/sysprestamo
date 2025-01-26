<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            'regex:/^[\pL\s\-]+$/u' // Solo letras y espacios
        ],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users,email'
        ],
        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            // Al menos: 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial
        ],
        'roles' => [
            'required',
            'array',
            'exists:roles,name'
        ]
    ]);

    try {
        $usuario = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $usuario->syncRoles($validated['roles']);

        return redirect()->route('admin.usuarios.index')
            ->with([
                'icono' => 'success',
                'mensaje' => 'Usuario creado exitosamente'
            ]);

    } catch (\Exception $e) {
        Log::error('Error al crear usuario: ' . $e->getMessage());
        return back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit($id)
    {
        $roles = Role::all();
        $usuario = User::find($id);
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */


    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ]);
        // dd($validatedData);
        try {
            // Buscar el usuario a actualizar
            $user = User::findOrFail($id);

            // Actualizar los datos básicos
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => !empty($validatedData['password']) ? Hash::make($validatedData['password']) : $user->password,
            ]);

            // Sincronizar roles
            $user->syncRoles($validatedData['roles']);

            return redirect()->route('admin.usuarios.index')
                ->with([
                    'icono' => 'success',
                    'mensaje' => 'Usuario actualizado exitosamente'
                ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Usuario no encontrado con ID ' . $id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Usuario no encontrado');

        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Error de base de datos al actualizar usuario con ID ' . $id . ': ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error en la base de datos al actualizar el usuario');

        } catch (\Exception $e) {
            Log::error('Error al actualizar usuario con ID ' . $id . ': ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar el usuario');
        }
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy($id)
    {

    }
}
