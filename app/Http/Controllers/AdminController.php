<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Pago;
use App\Models\Prestamo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index', [
            'total_configuraciones' => Configuracion::count(),
            'total_roles' => Role::count(),
            'total_usuarios' => User::count(),
            'total_clientes' => Cliente::count(),
            'total_prestamos' => Prestamo::count(),
            'total_pagos' => Pago::where('estado', 'Confirmado')->count(),
            'prestamos' => Prestamo::all(),
            'pagos' => Pago::where('estado', 'Confirmado')->get(),
        ]);
    }
}
