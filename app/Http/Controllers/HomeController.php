<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Variable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menu = 'crearRol';
        $roles = Role::with('permissions')->get();
        return view('admin.crearRol', compact('menu', 'roles'));
    }

    public function asignarRolUser()
    {
        $menu = 'asignarRolUser';
        $users = User::all();
        return view('admin.asignarRolUser', compact('menu', 'users'));
    }

    public function asignarRolUserEdit() //pintamos roles en el select 
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function cambiarRolUser(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            //$user->revokePermissionTo($request->rolAnterior);
            $user->removeRole($request->rolAnterior);
            $user->assignRole($request->name);

            return response()->json($request);
        } catch (\Throwable $th) {
            return response()->json($th); //me genera json vacio
        }
    }

    public function store(Request $request) //crea rol
    {
        try {
            $permission_array = [];

            foreach (request('permission_id') as $selected) {
                array_push($permission_array, $selected);
            }
            $superAdminRole = Role::create(['name' => request('name')]);
            $superAdminRole->syncPermissions($permission_array);

            return response()->json($permission_array);
        } catch (\Throwable $th) {
            return response()->json('Existe'); //en caso de unico por nombre
        }
    }
    public function editRol($id) //solo buscamos datos para pintalos en el edit rol
    {
        $roles = Role::findOrFail($id);
        $roles->permissions;
        return response()->json($roles);
    }

    public function UpdateRol(Request $request, $id) //update rol
    {
    
        $roles = Role::findOrFail($id);
        $roles->update([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        $roles->permissions()->sync($request->permission_id);
        return redirect()->back();

      
    }

    public function eliminarRol($id) //update rol
    {
        //$eventos = evento::findOrFail($id); //aqui buscamos el primer resultado con el id
        Role::destroy($id);
        return response()->json($id);
    }
}
