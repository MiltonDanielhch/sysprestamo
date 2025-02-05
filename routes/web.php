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
    // Rutas para clientes (descomentadas cuando se necesiten)
    Route::resource('admin/prestamos', PrestamoController::class)->names([
        'index' => 'admin.prestamos.index',
        'create' => 'admin.prestamos.create',
        'store' => 'admin.prestamos.store',
        'show' => 'admin.prestamos.show',
        'edit' => 'admin.prestamos.edit',
        'update' => 'admin.prestamos.update',
        'destroy' => 'admin.prestamos.destroy'
    ]);
    Route::get('/admin/prestamos/cliente/{id}', [PrestamoController::class, 'obtenerCliente'])->name('admin.prestamos.cliente.obtenerCliente');
    Route::get('/admin/prestamos/contratos/{id}', [PrestamoController::class, 'contratos'])->name('admin.prestamos.contratos');

    // Rutas para clientes (descomentadas cuando se necesiten)
    // Route::resource('admin/pagos', PagoController::class)->names([
    //     'index' => 'admin.pagos.index',
    //     'create' => 'admin.pagos.create',
    //     // 'store' => 'admin.pagos.store',
    //     'show' => 'admin.pagos.show',
    //     'edit' => 'admin.pagos.edit',
    //     'update' => 'admin.pagos.update',
    //     'destroy' => 'admin.pagos.destroy'
    // ]);

    // Route::get('/admin/pagos', [PagoController::class, 'index'])->name('admin.pagos.index'); // Para ver todos los pagos
    // Route::get('/admin/pagos/prestamos/cliente/{id}', [PagoController::class, 'cargarPrestamosCliente'])->name('admin.pagos.CargarPrestamosCliente');

    // // Mostrar formulario para crear un pago (si necesitas un ID específico, como cliente o préstamo)
    // Route::get('/admin/pagos/create/{id}', [PagoController::class, 'create'])->name('admin.pagos.create');

    // // Almacenar un nuevo pago
    // Route::post('/admin/pagos', [PagoController::class, 'store'])->name('admin.pagos.store');

    // // Mostrar detalles del pago
    // Route::get('/admin/pagos/{id}', [PagoController::class, 'show'])->name('admin.pagos.show');

    // // Editar un pago específico (la ruta PUT actualiza)
    // Route::get('/admin/pagos/{id}/edit', [PagoController::class, 'edit'])->name('admin.pagos.edit');
    // Route::put('/admin/pagos/{id}', [PagoController::class, 'update'])->name('admin.pagos.update');

    // // Eliminar un pago
    // Route::delete('/admin/pagos/{id}', [PagoController::class, 'destroy'])->name('admin.pagos.destroy');


    Route::get('/admin/pagos', [PagoController::class, 'index'])->name('admin.pagos.index');
    Route::get('/admin/pagos/prestamos/cliente/{id}', [PagoController::class, 'cargarPrestamosCliente'])->name('admin.pagos.CargarPrestamosCliente');
    Route::get('/admin/pagos/prestamos/create/{id}', [PagoController::class, 'create'])->name('admin.pagos.create');

    // Route::post('/admin/pagos/create/{pago}', [PagoController::class, 'store'])->name('admin.pagos.store');
    // Dentro del grupo de middleware auth
    Route::put('/admin/pagos/{id}', [PagoController::class, 'update'])->name('admin.pagos.update');
    Route::get('/admin/prestamos/comprobantedepago/{id}', [PagoController::class, 'comprobantedepago'])->name('admin.pagos.comprobantedepago');
    Route::get('/admin/pagos/{id}', [PagoController::class, 'show'])->name('admin.pagos.show');
    Route::post('/admin/pagos/{id}', [PagoController::class, 'destroy'])->name('admin.pagos.destroy');

    // Rutas notificaciones
    Route::get('/admin/notificaciones', [NotificacionController::class, 'index'])->name('admin.notificaciones.index');
    Route::get('/admin/notificaciones/notificar/{id}', [NotificacionController::class, 'notificar'])->name('admin.notificaciones.notificar');

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
