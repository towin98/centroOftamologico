<?php

namespace App\Http\Controllers;

use App\Medico;
use App\User;
use Exception;
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

    public function vistaCrearUsuario() //admin
    {
        $menu = 'crearUsuario';
        return view('admin.crearUsuario', compact('menu'));
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

            if ($request->name === '2') {
                $medico = Medico::where('id_user',$request->id)->get();
                if (count($medico) === 0) {
                    Medico::create([
                        'id_user' => $request->id,
                        'photo' => 'fotos/personPerfil.png',
                    ]);
                }   
            }
            if ($request->rolAnterior == 'Medico') {
                $medico = Medico::where('id_user',$request->id)->get();
                Medico::destroy($medico[0]->id);                 
            }

            return response()->json($request);
        } catch (Exception $e) {
            return response()->json($e); //me genera json vacio
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
