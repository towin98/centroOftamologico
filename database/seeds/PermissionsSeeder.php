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

        Permission::create(['name' => 'Agendar Cita']);
        Permission::create(['name' => 'Registrarse como medico']);
        Permission::create(['name' => 'Turno']);     
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
            'tipo_eps' => 'Comparta',
            'photo' => 'HHC56aSCWw0rHOZSRqAMZXLQA26LI8XEagyhLreT.jpeg'
        ]);
        //asignando rol
        $userSuperAdmin->assignRole('Administrador');

        /* $userViewBooks = User::create([
            'tipo' => 'cc',
            'documentNumber' => '55',
            'name' => 'test',
            'lastname' => 'test lastaname',
            'phone' => '32074',
            'email' => 'test@gmail.com',
            'password' => Hash::make('admin'),

            'direccion' => 'Cra 30 #51A - 51',
            'tipo_sangre' => 'B+',
            'tipo_eps' => 'Sumapas',
            'photo' => 'HHC56aSCWw0rHOZSRqAMZXLQA26LI8XEagyhLreT.jpeg'
        ]);
        //asignando rol
        $userViewBooks->assignRole('ver libros');

        User::create([
            'tipo' => 'cc',
            'documentNumber' => '550',
            'name' => 'Maria Beatriz',
            'lastname' => 'villanueva',
            'phone' => '320',
            'email' => 'test2@gmail.com',
            'password' => Hash::make('admin'),

            'direccion' => 'calle 40 #21 - 51',
            'tipo_sangre' => 'B+',
            'tipo_eps' => 'Sanitas',
            'photo' => 'HHC56aSCWw0rHOZSRqAMZXLQA26LI8XEagyhLreT.jpeg'
        ]); */
        
    }
}
