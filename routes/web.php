<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return redirect('/admin');
});

// Route::get('/home', [AdminController::class, 'home'])->name('home');

// Middleware para rutas administrativas
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('home');

    // Rutas para configuración del sistema
    Route::get('/admin/configuracion', [ConfiguracionController::class, 'index'])
        ->name('admin.configuracion.index')
        ->middleware('can:admin.configuracion.index');

    Route::get('/admin/configuracion/create', [ConfiguracionController::class, 'create'])
        ->name('admin.configuracion.create')
        ->middleware('can:admin.configuracion.create');

    Route::post('/admin/configuracion/create', [ConfiguracionController::class, 'store'])
        ->name('admin.configuracion.store')
        ->middleware('can:admin.configuracion.store');

    Route::get('/admin/configuracion/{id}', [ConfiguracionController::class, 'show'])
        ->name('admin.configuracion.show')
        ->middleware('can:admin.configuracion.show');

    Route::get('/admin/configuracion/{id}/edit', [ConfiguracionController::class, 'edit'])
        ->name('admin.configuracion.edit')
        ->middleware('can:admin.configuracion.edit');

    Route::put('/admin/configuracion/{id}', [ConfiguracionController::class, 'update'])
        ->name('admin.configuracion.update')
        ->middleware('can:admin.configuracion.update');

    Route::delete('/admin/configuracion/{id}', [ConfiguracionController::class, 'destroy'])
        ->name('admin.configuracion.destroy')
        ->middleware('can:admin.configuracion.destroy');

    // Rutas para gestión de roles
    Route::resource('admin/roles', RoleController::class)->names([
        'index' => 'admin.roles.index',
        'create' => 'admin.roles.create',
        'store' => 'admin.roles.store',
        'show' => 'admin.roles.show',
        'edit' => 'admin.roles.edit',
        'update' => 'admin.roles.update',
        'destroy' => 'admin.roles.destroy'
    ])->middleware('can:admin.roles.index');

    Route::get('/admin/roles/{id}/asignar', [RoleController::class, 'asignarPermisos'])
        ->name('admin.roles.asignarPermisos')
        ->middleware('can:admin.roles.asignarPermisos');

    Route::put('/admin/roles/asignar/{id}', [RoleController::class, 'updateAsignar'])
        ->name('admin.roles.updateAsignar')
        ->middleware('can:admin.roles.updateAsignar');

    // Rutas para usuarios
    Route::resource('admin/usuarios', UsuarioController::class)->names([
        'index' => 'admin.usuarios.index',
        'create' => 'admin.usuarios.create',
        'store' => 'admin.usuarios.store',
        'show' => 'admin.usuarios.show',
        'edit' => 'admin.usuarios.edit',
        'update' => 'admin.usuarios.update',
        'destroy' => 'admin.usuarios.destroy'
    ])->middleware('can:admin.usuarios.index');

    // Rutas para clientes
    Route::resource('admin/clientes', ClienteController::class)->names([
        'index' => 'admin.clientes.index',
        'create' => 'admin.clientes.create',
        'store' => 'admin.clientes.store',
        'show' => 'admin.clientes.show',
        'edit' => 'admin.clientes.edit',
        'update' => 'admin.clientes.update',
        'destroy' => 'admin.clientes.destroy'
    ])->middleware('can:admin.clientes.index');

    // Rutas para préstamos
    Route::resource('admin/prestamos', PrestamoController::class)->names([
        'index' => 'admin.prestamos.index',
        'create' => 'admin.prestamos.create',
        'store' => 'admin.prestamos.store',
        'show' => 'admin.prestamos.show',
        'edit' => 'admin.prestamos.edit',
        'update' => 'admin.prestamos.update',
        'destroy' => 'admin.prestamos.destroy'
    ])->middleware('can:admin.prestamos.index');

    Route::get('/admin/prestamos/cliente/{id}', [PrestamoController::class, 'obtenerCliente'])
        ->name('admin.prestamos.cliente.obtenerCliente')
        ->middleware('can:admin.prestamos.cliente.obtenerCliente');

    Route::get('/admin/prestamos/contratos/{id}', [PrestamoController::class, 'contratos'])
        ->name('admin.prestamos.contratos')
        ->middleware('can:admin.prestamos.contratos');

    // Rutas para pagos
    Route::get('/admin/pagos', [PagoController::class, 'index'])
        ->name('admin.pagos.index')
        ->middleware('can:admin.pagos.index');

    Route::get('/admin/pagos/prestamos/cliente/{id}', [PagoController::class, 'cargarPrestamosCliente'])
        ->name('admin.pagos.CargarPrestamosCliente')
        ->middleware('can:admin.pagos.CargarPrestamosCliente');

    Route::get('/admin/pagos/prestamos/create/{id}', [PagoController::class, 'create'])
        ->name('admin.pagos.create')
        ->middleware('can:admin.pagos.create');

    Route::put('/admin/pagos/{id}', [PagoController::class, 'update'])
        ->name('admin.pagos.update')
        ->middleware('can:admin.pagos.update');

    Route::get('/admin/prestamos/comprobantedepago/{id}', [PagoController::class, 'comprobantedepago'])
        ->name('admin.pagos.comprobantedepago')
        ->middleware('can:admin.pagos.comprobantedepago');

    Route::get('/admin/pagos/{id}', [PagoController::class, 'show'])
        ->name('admin.pagos.show')
        ->middleware('can:admin.pagos.show');

    Route::post('/admin/pagos/{id}', [PagoController::class, 'destroy'])
        ->name('admin.pagos.destroy')
        ->middleware('can:admin.pagos.destroy');

    // Rutas para notificaciones
    Route::get('/admin/notificaciones', [NotificacionController::class, 'index'])
        ->name('admin.notificaciones.index')
        ->middleware('can:admin.notificaciones.index');

    });

    Route::get('/admin/notificaciones/notificar/{id}', [NotificacionController::class, 'notificar'])
    ->name('admin.notificaciones.notificar')
    ->middleware('can:admin.notificaciones.notificar');

    Route::get('/admin/backup', [NotificacionController::class, 'index'])
        ->name('admin.notificaciones.index')
        ->middleware('can:admin.notificaciones.index');


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
