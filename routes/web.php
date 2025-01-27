<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/home', [AdminController::class, 'home'])->name('home');

// Middleware para rutas administrativas
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('home');
    // Rutas para configuración del sistema
    Route::get('/admin/configuracion', [ConfiguracionController::class, 'index'])->name('admin.configuracion.index');
    Route::get('/admin/configuracion/create', [ConfiguracionController::class, 'create'])->name('admin.configuracion.create');
    Route::post('/admin/configuracion/create', [ConfiguracionController::class, 'store'])->name('admin.configuracion.store');
    Route::get('/admin/configuracion/{id}', [ConfiguracionController::class, 'show'])->name('admin.configuracion.show');
    Route::get('/admin/configuracion/{id}/edit', [ConfiguracionController::class, 'edit'])->name('admin.configuracion.edit');
    Route::put('/admin/configuracion/{id}', [ConfiguracionController::class, 'update'])->name('admin.configuracion.update');
    Route::delete('/admin/configuracion/{id}', [ConfiguracionController::class, 'destroy'])->name('admin.configuracion.destroy');

    // Rutas para gestión de roles
    Route::resource('admin/roles', RoleController::class)->names([
        'index' => 'admin.roles.index',
        'create' => 'admin.roles.create',
        'store' => 'admin.roles.store',
        'show' => 'admin.roles.show',
        'edit' => 'admin.roles.edit',
        'update' => 'admin.roles.update',
        'destroy' => 'admin.roles.destroy'
    ]);

    // Rutas para usuarios (descomentadas cuando se necesiten)
    Route::resource('admin/usuarios', UsuarioController::class)->names([
        'index' => 'admin.usuarios.index',
        'create' => 'admin.usuarios.create',
        'store' => 'admin.usuarios.store',
        'show' => 'admin.usuarios.show',
        'edit' => 'admin.usuarios.edit',
        'update' => 'admin.usuarios.update',
        'destroy' => 'admin.usuarios.destroy'
    ]);
      // Rutas para clientes (descomentadas cuando se necesiten)
      Route::resource('admin/clientes', ClienteController::class)->names([
        'index' => 'admin.clientes.index',
        'create' => 'admin.clientes.create',
        'store' => 'admin.clientes.store',
        'show' => 'admin.clientes.show',
        'edit' => 'admin.clientes.edit',
        'update' => 'admin.clientes.update',
        'destroy' => 'admin.clientes.destroy'
    ]);
});

// Rutas autenticadas con Jetstream y Sanctum
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rutas de autenticación externa (OAuth, etc.)
Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('redirect');
Route::get('/auth/callback-url', [AuthController::class, 'callback'])->name('callback');
