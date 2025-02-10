<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrador = Role::create(['name' => 'Administrador', 'guard_name' => 'web']);

        //rutas para configuracion
        Permission::create(['name' => 'admin.configuracion.index', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.configuracion.create', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.configuracion.store', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.configuracion.show', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.configuracion.edit', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.configuracion.update', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.configuracion.destroy', 'guard_name' => 'web'])->syncRoles([$administrador]);

        //rutas para roles
        Permission::create(['name' => 'admin.roles.index', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.create', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.store', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.show', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.asignarPermisos', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.updateAsignar', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.edit', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.update', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.destroy', 'guard_name' => 'web'])->syncRoles([$administrador]);

        //rutas para usuarios
        Permission::create(['name' => 'admin.usuarios.index', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.create', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.store', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.show', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.edit', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.update', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.destroy', 'guard_name' => 'web'])->syncRoles([$administrador]);

        //rutas para clientes
        Permission::create(['name' => 'admin.clientes.index', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.clientes.create', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.clientes.store', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.clientes.show', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.clientes.edit', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.clientes.update', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.clientes.destroy', 'guard_name' => 'web'])->syncRoles([$administrador]);

        //rutas para prestamos
        Permission::create(['name' => 'admin.prestamos.index', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.prestamos.create', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.prestamos.cliente.obtenerCliente', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.prestamos.store', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.prestamos.show', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.prestamos.contratos', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.prestamos.edit', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.prestamos.update', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.prestamos.destroy', 'guard_name' => 'web'])->syncRoles([$administrador]);

        //rutas para pagos
        Permission::create(['name' => 'admin.pagos.index', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.pagos.CargarPrestamosCliente', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.pagos.create', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.pagos.store', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.pagos.comprobantedepago', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.pagos.show', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.pagos.edit', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.pagos.update', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.pagos.destroy', 'guard_name' => 'web'])->syncRoles([$administrador]);

        //rutas para notificaciones
        Permission::create(['name' => 'admin.notificaciones.index', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.notificaciones.notificar', 'guard_name' => 'web'])->syncRoles([$administrador]);

        //rutas para backups
        Permission::create(['name' => 'admin.backups.index', 'guard_name' => 'web'])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.backups.create', 'guard_name' => 'web'])->syncRoles([$administrador]);
    }
}
