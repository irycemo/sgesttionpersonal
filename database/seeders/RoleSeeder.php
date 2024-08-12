<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\Permission as Permiso;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role1 = Rol::create(['name' => 'Administrador']);
        $role2 = Rol::create(['name' => 'Delegado(a) Administrativo(a)']);
        $role3 = Rol::create(['name' => 'Contador(a)']);
        $role4 = Rol::create(['name' => 'Checador']);

        Permiso::create(['name' => 'Lista de roles', 'area' => 'Roles'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Crear rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Editar rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Borrar rol', 'area' => 'Roles'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Lista de permisos', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Crear permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Editar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Borrar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Lista de usuarios', 'area' => 'Usuarios'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Crear usuario', 'area' => 'Usuarios'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Editar usuario', 'area' => 'Usuarios'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Borrar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Lista de horarios', 'area' => 'Horarios'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Crear horario', 'area' => 'Horarios'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Editar horario', 'area' => 'Horarios'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Borrar horario', 'area' => 'Horarios'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Lista de permisos personal', 'area' => 'Permisos Personal'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Crear permiso personal', 'area' => 'Permisos Personal'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Editar permiso personal', 'area' => 'Permisos Personal'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Borrar permiso personal', 'area' => 'Permisos Personal'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Asignar permiso personal', 'area' => 'Permisos Personal'])->syncRoles([$role1, $role3]);
        Permiso::create(['name' => 'Formatos', 'area' => 'Permisos Personal'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Lista de incapacidades', 'area' => 'Incapacidades'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Crear incapacidad', 'area' => 'Incapacidades'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Editar incapacidad', 'area' => 'Incapacidades'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Borrar incapacidad', 'area' => 'Incapacidades'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Lista de personal', 'area' => 'Personal'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Crear personal', 'area' => 'Personal'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Editar personal', 'area' => 'Personal'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Borrar personal', 'area' => 'Personal'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Ver personal', 'area' => 'Personal'])->syncRoles([$role1, $role2, $role3]);

        Permiso::create(['name' => 'Lista de justificaciones', 'area' => 'Justificación'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Crear justificacion', 'area' => 'Justificación'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Editar justificacion', 'area' => 'Justificación'])->syncRoles([$role1, $role2]);
        Permiso::create(['name' => 'Borrar justificacion', 'area' => 'Justificación'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Lista de inhabiles', 'area' => 'Inhábiles'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Crear inhabil', 'area' => 'Inhábiles'])->syncRoles([$role1, $role2]);
        Permiso::create(['name' => 'Editar inhabil', 'area' => 'Inhábiles'])->syncRoles([$role1, $role2, $role3]);
        Permiso::create(['name' => 'Borrar inhabil', 'area' => 'Inhábiles'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Reportes', 'area' => 'Reportes'])->syncRoles([$role1, $role2, $role3]);

        Permiso::create(['name' => 'Checador', 'area' => 'Checador'])->syncRoles([$role1, $role2, $role3, $role4]);

        Permiso::create(['name' => 'Auditoria', 'area' => 'Auditoria'])->syncRoles([$role1]);

    }
}
