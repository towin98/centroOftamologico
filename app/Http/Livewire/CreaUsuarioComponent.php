<?php

namespace App\Http\Livewire;

use App\Eps;
use App\Medico;
use App\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreaUsuarioComponent extends Component
{
    public  $tipo, $photo, $documentNumber, $name, $lastname,
        $tipo_sangre, $tipo_eps, $phone, $email, $direccion, $password, $rol;

    public function render()
    {
        $tipoSangre = array(
            "A+",
            "B+",
            "O+",
            "AB+",
            "A-",
            "B-",
            "O-",
            "AB-"
        );
        $eps = Eps::all();
        $roles = Role::all();
        return view('livewire.crea-usuario-component', compact('roles','eps','tipoSangre'));
    }

    public function store()
    {
        $this->validate([
            'documentNumber' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|Numeric',
            'tipo' => 'required',
            'tipo_sangre' => 'required',
            'tipo_eps' => 'required',
            'direccion' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'rol' => 'required',

        ]);

        $userRolPaciente = User::create([
            'documentNumber' => $this->documentNumber,
            'tipo' => $this->tipo,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            
            'direccion' => $this->direccion,
            'tipo_sangre' => $this->tipo_sangre,
            'tipo_eps' => $this->tipo_eps,
            'photo' => 'fotos/perfil-undefined/personPerfil.png',
        ]);
        $userRolPaciente->assignRole($this->rol);

        if ($this->rol == 2) {
            Medico::create([
                'id_user' => $userRolPaciente->id,
                'photo' => 'fotos/personPerfil.png',
            ]);
        }

        $this->limpiarcampos();
        session()->flash('message', 'Datos guardados correctamente');
    }

    public function limpiarcampos()
    {
        $this->documentNumber = '';
        $this->tipo = '';
        $this->name = '';
        $this->lastname = '';
        $this->phone = '';
        $this->email = '';
        $this->password = '';
        $this->direccion = '';
        $this->tipo_sangre = '';
        $this->tipo_eps = '';
        $this->rol = '';
    }
}
