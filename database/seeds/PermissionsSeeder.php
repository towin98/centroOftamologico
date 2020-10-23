<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [];
        array_push($permisos, Permission::create(['name' => 'Editar datos']));
        array_push($permisos, Permission::create(['name' => 'Crear Rol']));
        array_push($permisos, Permission::create(['name' => 'Asignar Rol']));
        array_push($permisos, Permission::create(['name' => 'Ver medicos centro']));
        array_push($permisos, Permission::create(['name' => 'Ver citas y filtrar']));
        
        $administradorRole = Role::create(['name' => 'Administrador']);

        $administradorRole->syncPermissions($permisos); //en caso de querer darle 1 solo permiso a un rol

        Permission::create(['name' => 'Crear Usuarios']);
        Permission::create(['name' => 'Agendar Cita']);
        Permission::create(['name' => 'Crear agenda']);  
        Permission::create(['name' => 'Consultorios']);
        Permission::create(['name' => 'Asunto cita']);     

        Role::create(['name' => 'Medico']);
        Role::create(['name' => 'Paciente']);
        Role::create(['name' => 'Recepción']);
/* 
        $permission_array = [];
        array_push($permission_array, Permission::create(['name' => 'create']));
        array_push($permission_array, Permission::create(['name' => 'edit']));
        array_push($permission_array, Permission::create(['name' => 'delete']));

        $viewBooksPermission = Permission::create(['name' => 'view']); //para no repeat
        array_push($permission_array, $viewBooksPermission);

        $superAdminRole = Role::create(['name' => 'super_admin']);
        
        $superAdminRole->syncPermissions($permission_array); //sincronizar múltiples permisos a un rol utilizando 1 de estos métodos:

        //creamos otro rol
        $viewBooksRole = Role::create(['name' => 'ver libros']);
        $viewBooksRole->syncPermissions($viewBooksPermission); //en caso de querer darle 1 solo permiso a un rol */

        $userSuperAdmin = User::create([
            'tipo' => 'cc',
            'documentNumber' => '55064997',
            'name' => 'Maria Beatriz',
            'lastname' => 'villanueva',
            'phone' => '3208090774',
            'email' => 'maria@gmail.com',
            'password' => Hash::make('admin'),

            'direccion' => 'Cra 10 #21 - 51',
            'tipo_sangre' => 'B+',
            'tipo_eps' => 1,
            'photo' => 'fotos/personPerfil.png',
        ]);
        //asignando rol
        $userSuperAdmin->assignRole('Administrador');        
    }
}
